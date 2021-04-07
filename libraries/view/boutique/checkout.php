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

?>


<!-- Le conteneur des boutons PayPal -->
<div id="paypal-boutons"></div>



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
