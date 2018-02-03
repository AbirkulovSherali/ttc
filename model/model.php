<?php

    defined("CHECK") or die("Access denied!");

    function setMove($data) {
        global $mysqli;
        $query = "INSERT INTO moves (type_user, cell) VALUES ('{$data['user']}', {$data['cell']})";
        $mysqli->query($query) or die($mysqli->error);
        if($mysqli->affected_rows > 0){
            return true;
        }
        else{
            return false;
        }
    }

    function checkMove() {
        global $mysqli;
        $moves = [];
        $query = "SELECT * FROM moves";
        $res = $mysqli->query($query) or die($mysqli->error);
        if($res->num_rows){
            while($row = $res->fetch_assoc()){
                $moves[$row['cell']]['cell'] = $row['cell'];
                $moves[$row['cell']]['type_user'] = $row['type_user'];
            }
            return $moves;
        }
        else{
            return false;
        }
    }

    function dropAllMoves() {
        global $mysqli;
        $query = 'DELETE FROM moves';
        $res = $mysqli->query($query) or die($mysqli->error);
        if($mysqli->affected_rows > 0){
            return true;
        }
        else{
            return false;
        }
    }

    function saveGame($nickname) {
        global $mysqli;
        $current_date = date('d-y-Y', time());
        $query = "INSERT INTO users (user_name, count_move_user, count_move_comp, `date`, sec, img)
                    VALUES ('$nickname', {$_SESSION['count_move_user']}, {$_SESSION['count_move_comp']},
                            '$current_date', {$_SESSION['time']}, '{$_SESSION['photo']}')";
        $mysqli->query($query) or die($mysqli->error);
        if($mysqli->affected_rows > 0){
            return true;
        }
        else{
            false;
        }
    }

    function get_results() {
        global $mysqli;
        $query = "SELECT * FROM users";
        $results = [];
        $res = $mysqli->query($query) or die($mysqli->error);
        if($res->num_rows > 0){
            while($rows = $res->fetch_assoc()){
                $results[] = $rows;
            }
            return $results;
        }
        else{
            return false;
        }
    }

?>
