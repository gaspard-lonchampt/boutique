<?php
require_once '../../autoload.php';
require_once '../../../template/layout.html.php';

if ($_SESSION['customer']['customer_statut'] !== "2") {
    header('Location: ../boutique/redirection.html.php');
}


?>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Admin</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Commandes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="products.html.php">Produits</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="customer.html.php">Clients</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="categories-attribute.html.php">Catégories et Attributs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="inventaire.html.php">Inventaire</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ahonneur.php">Articles à l'honneur</a>
                </li>
                 <li class="nav-item">
                    <a class="nav-link" href="../boutique/accueil.php">Retour au site</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
