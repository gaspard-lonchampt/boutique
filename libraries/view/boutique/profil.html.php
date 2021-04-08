<?php
require_once '../../autoload.php';

if (!isset($_SESSION['customer']['customer_id']) > "0") {
    header('Location: redirection.html.php');
}

require_once 'layout_front.html.php';
require_once 'header.html.php';

$view = new \view\Customers();

$customer = new \controllers\Customers();

$commande = new \models\Panier();

@$customer_login = $_SESSION['customer']['customer_login'];
?>


<section class="section">
    <h3 class="has-text-centered mb-4">Vos commandes</h3>

    <div class="card column is-flex mb-6 is-align-items-center">
    <div class="column is-half is-flex">
        <div class="column has-text-centered pr-6">Numéro de commande</div>
    </div>
        <div class="column has-text-centered">Statut de la commande</div>
        <div class="column has-text-centered">Date de la commande</div>
        <div class="column has-text-centered">Total de la commande</div>
    </div>

<?php

$affichage = $commande->displayCommand();

// echo "<pre>";
// var_dump($affichage);
// echo "</pre>";


foreach ($affichage as $affichage): ?>

<?php

?>

    <div class="card column is-vcentered is-flex mt-6 is-align-items-center">
        <div class="column is-half has-text-centered is-flex is-justify-content-center is-align-content-center is-align-items-center">
            <div class="column is-centered"><h2><?php echo $affichage["order_id"]; ?> </h2></div>
        </div>
        <div class="column has-text-centered"><?php if($affichage["order_status_code"]) {
            echo "Commande en attente de validation";
        } else {
            echo "Commande validé";
        }; ?>
</div>
        <div class="column has-text-centered"><?php echo $affichage["date_order_placed"]; ?> </div>
        <div class="column has-text-centered"><?php echo $affichage["order_details"];
 ?>€</div>
</div>

    </div>
<?php endforeach;?>


<div class="container">
<h2 class="has-text-centered mt-6">Modifier vos informations</h2>
</div>
<?php

$one_customer_info = $customer->One_profil_display($customer_login);
$update_msg = $customer->updateProfil();




$view->One_profil_display($one_customer_info, $update_msg);

require_once 'footer.html.php';
