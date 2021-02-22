<?php
session_start();
require_once '../../../template/layout.html.php';
require_once '../../../libraries/models/Products.php';

$Produits = new Products();

?>
<main class="container">
    <div class="row">
    <!-- GESTION DES PRODUITS -->
    <section class="col-12">

        <!-- MESSAGE D ERREUR SI URL DETAILS PRODUIT INVALIDE -->
        <?php
        if (!empty($_SESSION['erreur'])) {
            echo '<div class="alert alert-danger" role="alert">' . $_SESSION['erreur'] . '</div>';
            $_SESSION['erreur'] ="";
        }
        ?>
        <!-- FIN MESSAGE D ERREUR -->

        <h1>Liste des Produits</h1>
        <table class="table">
            <thead>
                <th>ID</th>
                <th>Type Produit id</th>
                <th>Titre</th>
                <th>Description</th>
                <th>Autres Details</th>
            </thead>
            <tbody>
                <?php

                $allProduits = $Produits -> findAll();

                foreach ($allProduits as $produit)
                {
                    echo ('<form action="" method="get">
                               <tr>
                                   <td>' . $produit['product_id'] . '</td>
                                   <td>' . $produit['product_type_id'] . '</td>
                                   <td>' . $produit['product_name'] . '</td>
                                   <td>' . $produit['product_description'] . '</td>
                                   <td>' . $produit['other_product_details'] . '</td>
                                   <td><a href="detailsproduct.html.php?id=' . $produit['product_id'] . '">Voir les details</a></td>
                                   <td style="border: none;">
                                   <input type="submit" id="modify_Product" name="modify_Product" value="Modifier" class="btn btn-primary">
                                   <input type="hidden" id="hiddenModifyProduct" name="hiddenModifyProduct" value="' . $produit['product_id'] . '">
                                   <input type="submit" id="delete_Product" name="delete_Product" class="btn btn-danger" onclick="return confirm(\'Etes vous sûre de vouloir supprimer cet article ?\');" value="Supprimer">
                                   <input type="hidden" id="hiddenDeleteProduct" name="hiddenDeleteProduct" value="' . $produit['product_id'] . '">
                                   </td>
                               </tr>
                            </form>');
                }
                ?>
            </tbody>
        </table>
        <?php
        if (isset($_GET['modify_Product']))
        {
        $Produits -> displayUpdateProduit($_GET['product_id']);
        }

        if (isset($_GET['delete_Product']))
        {
            $Produits -> deleteProduct($_GET['hiddenDeleteProduct']);
        }
        ?>
    </section>
    </div>

    <!--AJOUT DUN NOUVEAU PRODUIT-->
    <?php $Produits->insertproduct(); ?>
    <form action="products.html.php" method="post">
        <input type="number" name="product_type_id"> <br>
        <input type="text" name="product_name" placeholder="Nom du produit"><br>
        <input type="text" name="product_description" placeholder="Description"><br>
        <input type="text" name="other_product_details" placeholder="something to add ?"><br>
        <button name="submit">Valider !</button>
    </form>
</main>
