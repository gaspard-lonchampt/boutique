<?php

require_once 'libraries/autoload.php';

$view = new \view\Customers();

$connect = new \controllers\Customers();

$connect_msg = $connect->connect();

$view->connect_form($connect_msg);
