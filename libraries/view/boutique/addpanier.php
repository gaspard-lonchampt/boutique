<?php
session_start();
require_once '../../autoload.php';
$panier = new \Models\Panier();

if (isset($_GET['id'])) {
    $product = $this->pdo->query('SELECT id FROM products WHERE id = :id', array('id' => $_GET['id']));
    if (empty($product)) {
        die("Ce produit n'existe pas");
    }
    $panier->add($product[0]->id);
    die('Le produit a bien été ajouté');
}
else {
    die("vous n'avez pas sélectionné de produit à ajouter");
}
?>