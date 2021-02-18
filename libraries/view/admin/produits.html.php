<?php
require_once '../../../template/layout.html.php';
require_once '../../autoload.php';
/**
 * ca fait apparaitre le !doctype
 */

$produits = new Models\Products();
$produits->findAll();