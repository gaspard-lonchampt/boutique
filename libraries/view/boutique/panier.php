<?php
    require_once '../../autoload.php';
    require_once 'layout_front.html.php';
    require_once 'header.html.php';

    $Panier = new \Models\Panier();

    var_dump($_SESSION['panier']);
    echo "<pre>";
    var_dump($_POST);
    echo "</pre>";

?>


<section class="section">
    <h1 class="title has-text-centered">Votre panier</h1>

    <div class="card column is-flex mb-6">
        <div class="column is-half has-text-centered">Nom du produit</div>
        <div class="column has-text-centered">Taille</div>
        <div class="column has-text-centered">Prix</div>
        <div class="column has-text-centered">Quantité</div>
        <div class="column has-text-centered">Total</div>
    </div>

    <?php
        $panier = $Panier->displaypanier();
        // $Produits->inventaire(array_keys($_SESSION['panier']));
        echo "<pre>";
        var_dump($panier);
        echo "</pre>";
    foreach ($panier as $panier): ?>

    <div class="card column is-flex">
        <div class="column is-half has-text-centered is-flex">
            <div class="column"><img src="" alt=""></div>
            <div class="column"><h2><?php echo $panier["product_name"]; ?> </h2><p><?php echo $panier["other_product_details"]; ?> </p></div>
        </div>
        <div class="column has-text-centered">Taille</div>
        <div class="column has-text-centered">Prix</div>
        <div class="column has-text-centered">Quantité</div>
        <div class="column has-text-centered">Total</div>
    </div>

    <?php endforeach;?>


</section>

<?php
require_once 'footer.html.php';
