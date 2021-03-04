<?php

spl_autoload_register(
    function ($className) {
        // var_dump($className);
        $className = str_replace("\\", "/", $className);
            include_once __DIR__ . "/" . $className . ".php";
    }
);
