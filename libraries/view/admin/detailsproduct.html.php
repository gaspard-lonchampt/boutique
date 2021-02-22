<?php
session_start();

// Est-ce qu'il existe et n'est pas vide dans l'url?
if (isset($_GET['product_id']) && !empty($_GET['product_id'])) {

    $produit = new Products();

    // On nettoie l'id envoyé
    $id = strip_tags($_GET['product_id']);

    $produit->findproducts($_GET['product_id']);

} else {
    $_SESSION['erreur'] = "URL invalide";
    header('Location: products.html.php');
}