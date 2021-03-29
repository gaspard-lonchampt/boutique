<?php

require_once '../autoload.php';
require_once '../../template/layout_front.html.php';
require_once '../../template/header.html.php';

$view = new \view\Customers();

$register = new \controllers\Customers();

$register_msg = $register->register();

$view->register_form($register_msg);

require_once '../../template/footer.html.php';
