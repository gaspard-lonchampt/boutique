<?php

require_once 'libraries/autoload.php';


$view = new \view\Customers();

$view->form();

$register = new \controllers\Customers();

$register->register();
