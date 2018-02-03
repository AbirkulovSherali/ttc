<?php

    function checkWinner($moves){
        if( @(($moves[1]['cell'] == 1 && $moves[1]['type_user'] == 'user') &&
            ($moves[2]['cell'] == 2 && $moves[2]['type_user'] == 'user') &&
            ($moves[3]['cell'] == 3 && $moves[3]['type_user'] == 'user')) ||

            @(($moves[4]['cell'] == 4 && $moves[4]['type_user'] == 'user') &&
            ($moves[5]['cell'] == 5 && $moves[5]['type_user'] == 'user') &&
            ($moves[6]['cell'] == 6 && $moves[6]['type_user'] == 'user')) ||

            @(($moves[7]['cell'] == 7 && $moves[7]['type_user'] == 'user') &&
            ($moves[8]['cell'] == 8 && $moves[8]['type_user'] == 'user') &&
            ($moves[9]['cell'] == 9 && $moves[9]['type_user'] == 'user')) ||



            @(($moves[1]['cell'] == 1 && $moves[1]['type_user'] == 'user') &&
            ($moves[4]['cell'] == 4 && $moves[4]['type_user'] == 'user') &&
            ($moves[7]['cell'] == 7 && $moves[7]['type_user'] == 'user')) ||

            @(($moves[2]['cell'] == 2 && $moves[2]['type_user'] == 'user') &&
            ($moves[5]['cell'] == 5 && $moves[5]['type_user'] == 'user') &&
            ($moves[8]['cell'] == 8 && $moves[8]['type_user'] == 'user')) ||

            @(($moves[3]['cell'] == 3 && $moves[3]['type_user'] == 'user') &&
            ($moves[6]['cell'] == 6 && $moves[6]['type_user'] == 'user') &&
            ($moves[9]['cell'] == 9 && $moves[9]['type_user'] == 'user')) ||



            @(($moves[1]['cell'] == 1 && $moves[1]['type_user'] == 'user') &&
            ($moves[5]['cell'] == 5 && $moves[5]['type_user'] == 'user') &&
            ($moves[9]['cell'] == 9 && $moves[9]['type_user'] == 'user')) ||

            @(($moves[3]['cell'] == 3 && $moves[3]['type_user'] == 'user') &&
            ($moves[5]['cell'] == 5 && $moves[5]['type_user'] == 'user') &&
            ($moves[7]['cell'] == 7 && $moves[7]['type_user'] == 'user'))   )
        {
            return "zero";
        } elseif( @(($moves[1]['cell'] == 1 && $moves[1]['type_user'] == 'computer') &&
            ($moves[2]['cell'] == 2 && $moves[2]['type_user'] == 'computer') &&
            ($moves[3]['cell'] == 3 && $moves[3]['type_user'] == 'computer')) ||

            @(($moves[4]['cell'] == 4 && $moves[4]['type_user'] == 'computer') &&
            ($moves[5]['cell'] == 5 && $moves[5]['type_user'] == 'computer') &&
            ($moves[6]['cell'] == 6 && $moves[6]['type_user'] == 'computer')) ||

            @(($moves[7]['cell'] == 7 && $moves[7]['type_user'] == 'computer') &&
            ($moves[8]['cell'] == 8 && $moves[8]['type_user'] == 'computer') &&
            ($moves[9]['cell'] == 9 && $moves[9]['type_user'] == 'computer')) ||



            @(($moves[1]['cell'] == 1 && $moves[1]['type_user'] == 'computer') &&
            ($moves[4]['cell'] == 4 && $moves[4]['type_user'] == 'computer') &&
            ($moves[7]['cell'] == 7 && $moves[7]['type_user'] == 'computer')) ||

            @(($moves[2]['cell'] == 2 && $moves[2]['type_user'] == 'computer') &&
            ($moves[5]['cell'] == 5 && $moves[5]['type_user'] == 'computer') &&
            ($moves[8]['cell'] == 8 && $moves[8]['type_user'] == 'computer')) ||

            @(($moves[3]['cell'] == 3 && $moves[3]['type_user'] == 'computer') &&
            ($moves[6]['cell'] == 6 && $moves[6]['type_user'] == 'computer') &&
            ($moves[9]['cell'] == 9 && $moves[9]['type_user'] == 'computer')) ||



            @(($moves[1]['cell'] == 1 && $moves[1]['type_user'] == 'computer') &&
            ($moves[5]['cell'] == 5 && $moves[5]['type_user'] == 'computer') &&
            ($moves[9]['cell'] == 9 && $moves[9]['type_user'] == 'computer')) ||

            @(($moves[3]['cell'] == 3 && $moves[3]['type_user'] == 'computer') &&
            ($moves[5]['cell'] == 5 && $moves[5]['type_user'] == 'computer') &&
            ($moves[7]['cell'] == 7 && $moves[7]['type_user'] == 'computer')) )
        {
            return "cross";
        } else {
            return false;
        }
    }

    function print_a($array){
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }

?>
