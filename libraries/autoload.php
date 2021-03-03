<?php

    spl_autoload_register( 
        function ($className) {
            // var_dump($className);
            $className = str_replace("\\", "/", $className);
            if ($repere = 1) {
                include_once"../../../libraries/$className.php";
            } else {
                include_once "libraries/$className.php";
            }
        }
    );
