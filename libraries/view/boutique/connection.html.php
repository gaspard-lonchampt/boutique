<?php

require_once '../../autoload.php';
if (isset($_SESSION['customer']['customer_id']) > "0") {
    header('Location: profil.html.php');
}

require_once 'layout_front.html.php';
require_once 'header.html.php';


$view = new \view\Customers();

$connect = new \controllers\Customers();

$connect_msg = $connect->connect();

$view->connect_form($connect_msg);

require_once 'footer.html.php';