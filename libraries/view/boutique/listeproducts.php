<?php
$repere = 1;
require_once '../../autoload.php';

$Panier = new \Models\Panier();
$Produits = new \Models\Products();

?>
<!-- AFFICHAGE DU TABLEAU AVEC PRODUITS -->
<table class="table">
    <thead>
    <th>Description type</th>
    <th>Titre</th>
    <th>Description</th>
    <th>Prix</th>
    </thead>
    <tbody>
    <?php

    $allProduits = $Produits -> displayProductInventaire();

    foreach ($allProduits as $produit)
    {
        //var_dump($produit);
        echo ('<tr>
                                   <td>' . $produit['product_type_description'] . '</td>
                                   <td>' . $produit['product_name'] . '</td>
                                   <td>' . $produit['product_description'] . '</td>
                                   <td>' . $produit['price'] . ' €</td>
                                   <td><a href="addpanier.php?id=' . $produit['product_id'] . '" class="btn btn-info">Ajouter au panier</a></td>
                                   
                          </tr>
                            ');
    }
    ?>
    </tbody>
</table>