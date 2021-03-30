<?php
require_once '../../autoload.php';
require_once 'layout_front.html.php';
require_once 'header.html.php';


$Produits = new \Models\Products();
$Panier = new \Models\Panier();

if (isset($_GET['product_id'])) {
    $Produits = $Produits->displayproducts();
    if (empty($Produits)) {
        die("Ce produit n'existe pas");
    }

    $Panier->add($Produits['product_id']);
    die('Le produit a bien été ajouté à votre panier');
    
    echo "<pre>";
    var_dump($Produits);
    echo "</pre>";
    // $_SESSION[]
} else {
    die("Vous n'avez pas sélectionné de produit à ajouter au panier");
}
