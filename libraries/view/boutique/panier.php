<?php
    require_once '../../autoload.php';
    require_once 'layout_front.html.php';
    require_once 'header.html.php';

    $Panier = new \Models\Panier();

    echo "<pre>";
    var_dump($_SESSION['panier']);
    var_dump($_SESSION['customer']);
    var_dump($_POST);
    echo "</pre>";
    if (isset($_GET['del'])) {
        $Panier->del($_GET['del']);
    }

    // todo : 
    // renvoyer vers la co si on va vers le checkout sans être co 
    // enregistrer les infos du panier en BDD
    // recapitulatif des commandes dans le profil
?>


<section class="section">
    <h1 class="title has-text-centered">Votre panier</h1>

    <div class="card column is-flex mb-6 is-align-items-center">
    <div class="column is-half is-flex">
        <div class="column is-half has-text-centered pr-0"></div>
        <div class="column has-text-centered pr-6">Nom du produit</div>
    </div>
        <div class="column has-text-centered">Taille</div>
        <div class="column has-text-centered">Prix</div>
        <div class="column has-text-centered">Quantité</div>
        <div class="column has-text-centered">Total</div>
    </div>

    <?php
        $panier = $Panier->displaypanier();
        // $Produits->inventaire(array_keys($_SESSION['panier']));
        // echo "<pre>";
        // var_dump($panier);
        // echo "</pre>";
    foreach ($panier as $panier): ?>

    <div class="card column is-vcentered is-flex mt-6 is-align-items-center">
        <div class="column is-half has-text-centered is-flex is-justify-content-center is-align-content-center is-align-items-center">
            <div class="column is-one-quarter"><img src="../images/<?php echo $panier["product_image_1"]; ?>" alt="image_produit"></div>
            <div class="column is-one-fifth"><a class="button" href="panier.php?del=<?php echo $panier["product_id"]; ?>"><i class="far fa-trash-alt"></i></a></div>
            <div class="column is-centered"><h2><?php echo $panier["product_name"]; ?> </h2><p><?php echo $panier["other_product_details"]; ?> </p></div>
        </div>
        <div class="column has-text-centered"><?php echo $_SESSION['panier'][$panier["product_id"]]['taille']; ?>
</div>
        <div class="column has-text-centered"><?php echo $_SESSION['panier'][$panier["product_id"]]['prix']; ?>€</div>
        <div class="column has-text-centered"><?php echo $_SESSION['panier'][$panier["product_id"]]['quantity']; ?>
</div>
        <div class="column has-text-centered"><?php echo $_SESSION['panier'][$panier["product_id"]]['quantity'] * $_SESSION['panier'][$panier["product_id"]]['prix'] ?>€</div>

    </div>
    <?php endforeach;?>
    <!-- <div class="card column is-vcentered is-flex mt-6 is-align-items-center">
        <div class="column is-half has-text-centered is-flex is-justify-content-center is-align-content-center is-align-items-center">
            <div class="column is-one-quarter"></div>
            <div class="column is-one-fifth"></div>
            <div class="column is-centered"></div>
        </div>
        <div class="column has-text-centered"></div>
        <div class="column has-text-centered"></div>
        <div class="column has-text-centered"></div>
        <div class="column has-text-centered">Grand Total:€</div>

    </div> -->
        <div class="container mt-6 is-flex is-justify-content-flex-end">
<?php if (empty($_SESSION['panier'])): ?>
        <a href="">
        <input class="button is-warning" type="submit" value="Panier vide"></input>
        </a>
<?php else: ?>
        <a href="checkout.php">
        <input class="button is-warning" type="submit" value="Procéder au paiement"></input>
        </a></div>
<?php endif; ?>

</section>

<?php
require_once 'footer.html.php';
