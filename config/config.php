<?php

    $mysqli = new mysqli("localhost", "root", "1234", 'ttc');

    if($mysqli->connect_errno){
    	die('Ошибка подключения: '.$mysqli->connect_error);
    }

    $mysqli->query('SET NAMES `utf8`');

?>
