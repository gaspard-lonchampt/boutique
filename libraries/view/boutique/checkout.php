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
	paypal.Buttons().render("#paypal-boutons");
</script>

<?php
require_once 'footer.html.php';
