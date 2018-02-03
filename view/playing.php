<?php $message = checkWinner($moves) ?>
<article class="col col-game-spacing">
    <article class="subtitle-row">
        <h2>Игра...</h2>
        <article class="alert-spacing">
            <?php if(isset($_SESSION['winner'])): ?>
                <?= $_SESSION['winner'] ?>
            <?php endif ?>
        </article>
        <figure class="container-photo circle img_tic o"></figure>
        <figure class="container-photo circle img_tic x"></figure>
        <p class="dates">Время: <span class="time"><?= $_SESSION['time'] ?> сек.</span></p>
        <h3 class="relative-pos-game">
            <span class="points"><span class="nameuser">Игрок: <span class="usermoves moves">2</span></span></span><span class="points"><span class="computer">Компьютер: <span class="computermoves moves">2</span></span></span>
        </h3>
    </article>
    <article class="container-row relative-pos-game">
        <article class="game">
            <?php for($i = 1; $i <= 9; $i++): ?>
                <?php if(isset($moves[$i]) && $moves[$i]['type_user'] == 'user'): ?>
                    <article class="field"><button id="<?= $i ?>" disabled class="btn img_tic o"></button></article>
                <?php elseif(isset($moves[$i]) && $moves[$i]['type_user'] == 'computer'): ?>
                    <article class="field"><button id="<?= $i ?>" disabled class="btn img_tic x"></button></article>
                <?php else: ?>
                    <article class="field"><button id="<?= $i ?>" class="btn img_tic"></button></article>
                <?php endif ?>
            <?php endfor ?>
        </article>
    </article>

    <article class="container-row center form">
        <article class="form-win" style="display: <?= $_SESSION['hidden_false'] ?>">
            <form>
                <label for="nickname">Введите своё имя </label>
                <input id="nickname" type="text" name="nickname" placeholder="Имя">
                <input type="submit" name="" id="" class="" value="Отправить">
            </form>
        </article>
        <br>
    </article>

    <div class="button-start">
        <a href="index.php?view=playing&amp;game=new_game"><button>НОВАЯ ИГРА</button></a>
    </div>

    <div class="button-exit">
        <a href="index.php?view=new_game&amp;exit=exit"><button>ПОКИНУТЬ ИГРУ</button></a>
    </div>
</article>

<script type="text/javascript">

    /* put any js-code here */

    $(document).ready(function(){

        var message = "<?= $message ?>";
        var checkVisible = "<?= $_SESSION['hidden_false'] ?>";
        if(checkVisible != 'block') $('.container-row .form-win').hide();

        function rand(min, max){
            min = parseInt(min);
            max = parseInt(max);
            return Math.floor( Math.random() * (max - min + 1) ) + min;
        }

        function disableEmptyCells() {
            for(i = 1; i <= 9; i++){
                var element = $('#' + i);
                if(!element.hasClass('o') && !element.hasClass('x')){
                    element.attr('disabled', 'disabled');
                }
            }
        }

        function enableEmptyCells(){
            for(i = 1; i <= 9; i++){
                var element = $('#' + i);
                if(!element.hasClass('o') && !element.hasClass('x')){
                    element.removeAttr('disabled');
                }
            }
        }

        /* Блокирование ячеек после завершения игры, даже когда страница обновляется */
        if(message){
            $('.img_tic').attr('disabled', 'disabled');
            console.log(message);
        }

        function computerMove(){
            var selectors = [];
            for(i = 1; i <= 9; i++){
                var element = $('#' + i);
                if(!element.hasClass('o') && !element.hasClass('x')){
                    if(element.selector == "#0") continue;
                    selectors.push(parseInt(element.selector.substr(1)));
                }
            }

            var computerMove = selectors[rand(0, selectors.length - 1)];

            $.ajax({
                type: "post",
                url: "",
                data: {cell: computerMove, type_user: "computer", time: second},
                success: function(res){
                    res = JSON.parse(res);
                    if(res.user == "user"){
                        $('#' + res.cell ).addClass('o').attr('disabled', 'disabled');
                    }
                    if(res.user == "computer"){
                        $('#' + res.cell ).addClass('x').attr('disabled', 'disabled');
                    }
                    if(res.message){
                        if(res.message == 'zero'){
                            $('.alert-spacing').html('<article class="alert game-alert">Вы выиграли!!</article>');
                        }
                        else if(res.message == 'cross'){
                            $('.alert-spacing').html('<article class="alert game-alert">Вы проиграли!!</article>');
                        } else if(res.message == 'none') {
                            $('.alert-spacing').html('<article class="alert game-alert">Ничья!!</article>');
                        }
                        $('.img_tic').attr('disabled', 'disabled');
                        console.log(res.message);
                        clearInterval(intervalId);
                    }
                    enableEmptyCells();
                }
            });
        }

        var typeUser = "<?= $_SESSION['type_user'] ?>";
        var gameOver = "<?= $game_over ?>";
        var second = "<?= $_SESSION['time'] ?>";

        /* Если игра не закончена, считаем время... */
        if(!gameOver){
            if(!second) second = 0;
            var intervalId;
            intervalId = setInterval(function(){
                second++;
                $('.time').empty().text(second + ' сек.');
                $.ajax({
                    type: 'get',
                    url: '',
                    data: {time: second},
                    success: function(res){
                        //console.log(res);
                    }
                });
            }, 1000);
        } else {
            clearInterval(intervalId);
        }

        if(typeUser == 'computer' && !gameOver){
            disableEmptyCells();
            console.log(typeUser);
            setTimeout(function(){
                computerMove();
            }, 2000);
        }

        /* Ходит пользователь */
        $('.img_tic').click(function(){
            disableEmptyCells();
            $.ajax({
                type: "post",
                url: "",
                data: {cell: $(this).attr('id'), type_user: "user", time: second},
                success: function(res){
                    res = JSON.parse(res);
                    console.log(res.countMoveComp);
                    console.log(res.countMoveUser);
                    test = res.user;
                    if(res.user == "user"){
                        $('#' + res.cell ).addClass('o').attr('disabled', 'disabled');
                    }
                    if(res.user == "computer"){
                        $('#' + res.cell ).addClass('x').attr('disabled', 'disabled');
                    }

                    /* Если партия не закончена, ходит компьютер */
                    if(!res.message){
                        /* Через 2 секунды ходит компьютер... */
                        setTimeout(function(){
                            computerMove();
                        }, 2000);
                    }
                    else{
                        /* Иначе объявляется победитель... */
                        if(res.message == 'zero'){
                            $('.alert-spacing').html('<article class="alert game-alert">Вы выиграли!!</article>');
                            $('.container-row .form-win').show();
                        }
                        else if(res.message == 'cross'){
                            $('.alert-spacing').html('<article class="alert game-alert">Вы проиграли!!</article>');
                        } else if(res.message == 'none') {
                            $('.alert-spacing').html('<article class="alert game-alert">Ничья!!</article>');
                        }
                        $('.img_tic').attr('disabled', 'disabled');
                        clearInterval(intervalId);
                    }
                }
            });
        });

        $('#nickname').change(function(){
            if($(this).val()){
                $('.alert-spacing-error').remove();
            }
            else{
                $('.alert-spacing-error').remove();
                $('.form-win').append("<article class='alert-spacing-error'><article class='alert'><span class='underline'>Сообщение:</span> Введите своё имя !!</article></article>");
            }
        });

        $("input[type='submit']").click(function(e){
            e.preventDefault();
            if($('#nickname').val() == false){
                $('.alert-spacing-error').remove();
                $('.form-win').append("<article class='alert-spacing-error'><article class='alert'><span class='underline'>Сообщение:</span> Введите своё имя !!</article></article>");
            }
            else{
                $.ajax({
                    type: 'get',
                    url: '',
                    data: {save_game: second, nickname: $('#nickname').val()},
                    success: function(res){
                        window.location = 'index.php?view=new_game';
                    }
                });
            }
        });

    });

</script>
