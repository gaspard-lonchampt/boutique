<?php
$repere = 1;
require_once '../../autoload.php';
require_once 'nav.html.php';




$view = new \view\Customers();


$All_profil_display = new \controllers\Customers();

$column_name = $All_profil_display->getColumnName();

$All_infos = $All_profil_display->All_profil_display();

$view->All_profil_display_with_update($All_infos, $column_name);
