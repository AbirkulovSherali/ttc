<?php

    session_start();

    defined("CHECK") or die("Access denied!");

    /* Определение пользоваля, кто ходит. Первым ходит компьютер... */
    $_SESSION['type_user'] = isset($_SESSION['type_user']) ? $_SESSION['type_user'] : 'computer';

    /* Если партия не закончена, то скрываем форму отправки результата, иначе показываем форму... */
    $_SESSION['hidden_false'] = isset($_SESSION['hidden_false']) ? $_SESSION['hidden_false'] : false;

    /* Подсчет ходов обеих сторон... */
    $_SESSION['count_move_comp'] = isset($_SESSION['count_move_comp']) ? $_SESSION['count_move_comp'] : 0;
    $_SESSION['count_move_user'] = isset($_SESSION['count_move_user']) ? $_SESSION['count_move_user'] : 0;

    /* Сохранение времени из браузера... */
    $_SESSION['time'] = isset($_SESSION['time']) ? $_SESSION['time'] : 0;

    /* Определение и подключение шаблона... */
    $view = isset($_GET['view']) ? $_GET['view'] : 'new_game';

    /* Инициализация старта игры */
    if($view == 'playing'){
        $_SESSION['start'] = isset($_SESSION['start']) ? $_SESSION['start'] : true;
    }

    /* Если пользователь пытается вернуться на страницу с законченной игрой... */
    if($view == 'playing' && !$_SESSION['start']){
        unset($_SESSION['start']);
        header('Location: /');
    }

    /* Вывод из БД заполненных ячеек... */
    $moves = checkMove() ? checkMove() : false;

    /* Инициализация сообщения о победителе... */
    $message = false;

    /* Фиксирование конца игры... */
    $game_over = isset($_SESSION['game_over']) ? $_SESSION['game_over'] : false;

    /* Вывод всех результатов из БД... */
    $results = get_results();

    /* Удаление всей информации о законченной игре, начало новой... */
    if(isset($_GET['game'])){
        unset($_SESSION['start']);
        unset($_SESSION['count_move_comp'], $_SESSION['count_move_user'], $_SESSION['time']);
        unset($_SESSION['type_user'], $_SESSION['game_over'], $_SESSION['hidden_false'], $_SESSION['winner']);
        dropAllMoves();
        header('Location: index.php?view=playing');
    }

    /* Покинуть игру... */
    if(isset($_GET['exit'])){
        $_SESSION['start'] = false;
        unset($_SESSION['type_user'], $_SESSION['game_over'], $_SESSION['hidden_false'], $_SESSION['winner']);
        unset($_SESSION['count_move_comp'], $_SESSION['count_move_user'], $_SESSION['time'], $_SESSION['photo']);
        dropAllMoves();
        header('Location: /');
    }

    /* Ход одного из пользователей... */
    if(isset($_POST['cell'])){

        /* Сохраняем данные о том, кто ходит и выбранной ячейки... */
        $data = ['user' => $_POST['type_user'], 'cell' => $_POST['cell']];
        if(setMove($data)){
            if($_POST['type_user'] == 'user'){
                /* Считаем ходы пользователя... */
                $_SESSION['count_move_user']++;
                /* Меняем пользователя на компьютер... */
                $_SESSION['type_user'] = 'computer';
            }
            elseif($_POST['type_user'] == 'computer'){
                /* Считаем ходы компьютера... */
                $_SESSION['count_move_comp']++;
                /* Меняем компьютер на пользователя... */
                $_SESSION['type_user'] = 'user';
            }
            /* Выводим все ходы из БД, сохраняя их положения после обновления браузера... */
            $moves = checkMove() ? checkMove() : false;
            /* Проверяем победителя... */
            $message = checkWinner($moves);
            if($message == 'zero'){
                /* Если победил пользователь... */
                /* Выводим табло о выигрыше, иначе о проигрыше... */
                $_SESSION['winner'] = '<article class="alert game-alert">Вы выиграли!!</article>';
                /* Сохраняем состояние видимости формы с сохранением результатов... */
                $_SESSION['hidden_false'] = 'block';
            }
            elseif($message == 'cross'){
                /* Если победил компьютер... */
                $_SESSION['winner'] = '<article class="alert game-alert">Вы проиграли!!</article>';
            }
            elseif((!$message && $_SESSION['count_move_comp'] == 5) || (!$message && $_SESSION['count_move_user'] == 5)) {
                /* Если победил ничья... */
                $_SESSION['winner'] = '<article class="alert game-alert">Ничья!!</article>';
                $message = 'none';
            }
            /* Если игра закончена, то сохраняем истину завершения игры... */
            if($message) $_SESSION['game_over'] = true;
        }

        if($_SESSION['type_user'] == 'user'){
            $type_user = 'computer';
        }
        else{
            $type_user = 'user';
        }

        exit(json_encode([
            'user' => $type_user, 'cell' => $_POST['cell'], 'message' => $message,
            'countMoveComp' => $_SESSION['count_move_comp'], 'countMoveUser' => $_SESSION['count_move_user']
        ]));

    }

    if(isset($_GET['time'])){
        $_SESSION['time'] = $_GET['time'];
        exit($_SESSION['time'].' second');
    }

    if(isset($_GET['save_game'])){
        $_SESSION['time'] = $_GET['save_game'];
        if(saveGame($_GET['nickname'])){
            unset($_SESSION['type_user'], $_SESSION['game_over'], $_SESSION['hidden_false'], $_SESSION['winner']);
            unset($_SESSION['count_move_comp'], $_SESSION['count_move_user'], $_SESSION['time'], $_SESSION['photo']);
            dropAllMoves();
        }
        exit("Ok!");
    }

    /* Загрузка фото на сервер */
    if(isset($_FILES['photo'])){

        if($_FILES['photo']['name']){
            $mime_type = ['image/gif', 'image/jpeg', 'image/png'];
            $max_size = 500000;
            $upload_file = 'uploads/';
            $file_name = $_FILES['photo']['name'];
            $file_extension = preg_replace('#.+\.([a-z]+)$#i', '$1', $file_name);
            $new_file_name = time().'.'.$file_extension;

            if(!in_array($_FILES['photo']['type'], $mime_type) || $_FILES['photo']['size'] > $max_size){
                $_SESSION['image_error'] = '<article class="alert-spacing-error">
                                                <article class="alert"><span class="underline">Ошибка при загрузке фото:</span> Проверьте размер или тип файла!!</article>
                                            </article>';
            }
        }

        if($_FILES['photo']['error'] == 0){
            if(move_uploaded_file($_FILES['photo']['tmp_name'], $upload_file.$new_file_name)){
                $_SESSION['photo'] = $new_file_name;
            }
        }
        
        header('Location: index.php?view=playing');
    }

    require_once "view/main.php";

?>
