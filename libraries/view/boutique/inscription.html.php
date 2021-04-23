<?php
require_once '../../autoload.php';
if (isset($_SESSION['customer']['customer_id']) > "0") {
    header('Location: profil.html.php');
}


require_once 'layout_front.html.php';
require_once 'header.html.php';



// var_dump($_SESSION);

$view = new \view\Customers();

$register = new \controllers\Customers();

$register_msg = $register->register();

$view->register_form($register_msg);

require_once 'footer.html.php';
