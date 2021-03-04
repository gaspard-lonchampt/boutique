<?php

session_start();

require_once '../autoload.php';


$view = new \view\Customers();

$customer = new \controllers\Customers();

@$customer_login = $_SESSION['customer']['customer_login'];

$one_customer_info = $customer->One_profil_display($customer_login);

$update_msg = $customer->updateProfil();

$view->One_profil_display($one_customer_info, $update_msg);
