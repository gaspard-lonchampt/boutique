<?php

    require_once '../../autoload.php';
    require_once 'layout_front.html.php';
    require_once 'header.html.php';

    if (!isset($_SESSION['customer']['customer_id'])) {
    header('Location: redirection.html.php');
    }

    if (empty($_SESSION['panier'])) {
        die('Votre panier est vide');
    }

    $Panier = new \models\Panier();

?>

<section class="section">
    <h1 class="title has-text-centered">Recapitulatif Paiement</h1>

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
    <div class="card column is-vcentered is-flex mt-6 is-align-items-center">
        <div class="column is-half has-text-centered is-flex is-justify-content-center is-align-content-center is-align-items-center">
            <div class="column is-one-quarter"></div>
            <div class="column is-one-fifth"></div>
            <div class="column is-centered"></div>
        </div>
        <div class="column has-text-centered"></div>
        <div class="column has-text-centered"></div>
        <div class="column has-text-centered"></div>
        <div class="column has-text-centered">Grand Total:  <?php echo $Panier->montantTotal(); ?>€</div>

    </div>

<section class="hero is-halfheight mt-6">
<div class="container is-flex is-justify-content-center is-align-content-center is-align-items-center">
<!-- Le conteneur des boutons PayPal -->
<div id="paypal-boutons"></div>
</div>
</section>



<!-- 1. Importation de la SDK JavaScript PayPal -->
<script src="https://www.paypal.com/sdk/js?client-id=AWYv2ajN2dxHjTlSCv2f-wW-sA1msAC5ML2qAqDeQ_nzV04IQhbLf928iLLnmHai5d4HCc7llxJ3jsWX"></script>
<script>
	// 2. Afficher le bouton PayPal
	// paypal.Buttons().render("#paypal-boutons");

function initPayPalButton() {
paypal.Buttons({
    style: {
    shape: 'pill',
    color: 'silver',
    layout: 'vertical',
    label: 'paypal',
    
    },

    createOrder: function(data, actions) {
    return actions.order.create({
        purchase_units: [{"amount":{"currency_code":"USD","value":1}}]
    });
    },

    onApprove: function(data, actions) {
    return actions.order.capture().then(function(details) {
        alert('Transaction completed by ' + details.payer.name.given_name + '!');
        window.location.replace("addcommande.php");
    });
    },

    onError: function(err) {
    console.log(err);
    }
}).render('#paypal-boutons');
}
initPayPalButton();
</script>

<?php
require_once 'footer.html.php';
