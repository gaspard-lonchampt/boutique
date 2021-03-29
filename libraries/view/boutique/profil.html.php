<?php
require_once '../../autoload.php';

if (!isset($_SESSION['customer']['customer_id']) > "0") {
    header('Location: connection.html.php');
}

require_once 'layout_front.html.php';
require_once 'header.html.php';

$view = new \view\Customers();

$customer = new \controllers\Customers();

@$customer_login = $_SESSION['customer']['customer_login'];

$one_customer_info = $customer->One_profil_display($customer_login);

$update_msg = $customer->updateProfil();

$view->One_profil_display($one_customer_info, $update_msg);

require_once 'footer.html.php';
