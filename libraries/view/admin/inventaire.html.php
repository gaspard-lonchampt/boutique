<?php
require_once 'nav.html.php';
require_once '../../../libraries/models/Products.php';
require_once '../../../libraries/models/Categories.php';
$inventaire = new Products();

?>
<main class="container">
    <div class="row">
        <!-- INVENTAIRE-->
        <section class="col-12">
            <h1>Inventaire complet des produits</h1>
            <!-- AFFICHAGE DU TABLEAU AVEC PRODUITS -->
            <table class="table">
                <thead>
                <th> </th>
                <th>Catégorie</th>
                <th>Produit</th>
                <th>Description</th>
                <th>Couleur</th>
                <th>Taille</th>
                <th>Quantité</th>
                <th>Prix</th>
                </thead>
                <tbody>
                <?php

                $allProduits = $inventaire -> displayProductInventaire();

                foreach ($allProduits as $produit)
                {
                    //var_dump($produit);
                    echo ('<tr>
                                   <td><img src="../images/" style="width: 100px" /></td>
                                   <td>' . $produit['product_type_description'] . '</td>
                                   <td>' . $produit['product_name'] . '</td>
                                   <td>' . $produit['product_description'] . '</td>
                                   <td>' . $produit['attribute_value_id'] . '</td>
                                   <td>(pareil)</td>
                                   <td>' . $produit['quantity'] . '</td>
                                   <td>' . $produit['price'] . '</td>
                                   <td><a href="detailsproduct.html.php?product_id=' . $produit['product_id'] . '" class="btn btn-info">Voir les details</a></td>
                                   
                          </tr>
                            ');
                }
                ?>
                </tbody>
            </table>
        </section>
    </div>
</main>
