<?php
require_once '../../autoload.php';
require_once 'layout_front.html.php';
require_once 'header.html.php';

$Produits = new \models\Products();
$Panier = new \models\Panier();

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
    ?> 
    <section class="hero is-halfheight">
    <div class="container mt-6">
    <h2 class="has-text-centered">
    <?php echo "Le produit a bien été ajouté à votre panier"; ?>
    </h2></div>
    </section> <?php
    // $_SESSION[]
} else {
    ?>
     <section class="hero is-halfheight">
    <div class="container mt-6">
    <h2 class="has-text-centered">
     <?php echo "Vous n'avez pas sélectionné de produit à ajouter au panier"; ?>
    </h2></div></section> <?php
}

require_once 'footer.html.php';