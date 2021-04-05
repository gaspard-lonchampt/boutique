<?php
require_once '../../autoload.php';
require_once 'layout_front.html.php';
require_once 'header.html.php';

$Produits = new \Models\Products();
$Panier = new \Models\Panier();

// unset($_SESSION['panier']);

if (isset($_GET['product_id'])) {
    $Produits = $Produits->displayproducts();
    if (empty($Produits)) {
        die("Ce produit n'existe pas");
    }

    // echo "<pre>";
    // var_dump($Produits);
    // echo "</pre>";

    // echo "<pre>";
    // var_dump($_SESSION['panier']);
    // echo "</pre>";

    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";

    // echo "<pre>";
    // var_dump($_GET);
    // echo "</pre>";

    $Panier->add($Produits['product_id'], $_POST['taille'], $_POST['quantity'], $_SESSION['stock'][0]['price']);
    die('Le produit a bien été ajouté à votre panier');

    // $_SESSION[]
} else {
    die("Vous n'avez pas sélectionné de produit à ajouter au panier");
}

require_once 'footer.html.php';
