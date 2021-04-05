<?php
require_once '../../autoload.php';
require_once 'nav.html.php';
$repere = 1;





$Produits = new \Models\Products();
$Categories = new \Models\Categories();

?>
<?php

/**
 * POUR SUPPRIMER UN ARTICLE
 */
if (isset($_GET['delete_Product']))
{
    $Produits->deleteProduct($_GET['hiddenDeleteProduct']);
}
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

            <!-- MESSAGE POUR PRODUIT AJOUTE -->
            <?php
            if (!empty($_SESSION['message'])) {
                echo '<div class="alert alert-success" role="alert">' . $_SESSION['message'] . '</div>';
                $_SESSION['message'] ="";
            }
            ?>
            <!-- FIN MESSAGE -->

            <h1>Liste des Produits</h1>

            <!-- FORM POUR LE BOUTON AJOUTER -->
            <form method="POST">
                <input type="submit" name="addProduct" value="Ajouter un produit" class="btn btn-primary">
            </form>
            <!-- FIN DE FORM BOUTON AJOUTER-->

            <?php
            /**
             * AFFICHAGE DU FORM POUR AJOUT PRODUIT
             */
            if (isset($_POST['addProduct']) || (isset($_POST['formAddProduct']))) {
                ?>

                <!-- AJOUT DES PRODUITS -->
                <?php $Produits->insertproduct();
                if (isset($_POST['addProduct']))
                { ?>
                    <form action="products.html.php" method="post">
                        <div class="form-group">
                            <label for="attribut">Type de produit</label>
                            <select name="product_type_id" id="product_type_id" class="form-control">
                                <?php
                                $allCat = $Categories->findAllCategories();
                                foreach ($allCat as $cat)
                                {
                                    echo ('<option value="' . $cat['product_type_id'] . '"> type : ' . $cat['product_type_description'] . '</option>');
                                }?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="product_name">Nom du produit</label>
                            <input type="text" name="product_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="product_description">Description du produit</label>
                            <input type="text" name="product_description" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="other_product_details">Détail du produit</label>
                            <input type="text" name="other_product_details" class="form-control">
                        </div>
                        <button type="submit" name="formAddProduct" class="btn btn-success">Valider !</button>
                    </form>
                    <!-- FIN AJOUT DES PRODUITS -->
                    <?php
                }
            }
            ?>

            <!-- AFFICHAGE DU TABLEAU AVEC PRODUITS -->
            <table class="table">
                <thead>
                <th>ID</th>
                <th>Description type</th>
                <th>Titre</th>
                <th>Description</th>
                <th>Autres Details</th>
                </thead>
                <tbody>
                <?php

                $allProduits = $Produits -> findAllproduct();

                foreach ($allProduits as $produit)
                {
                    echo ('<tr>
                                   <td>' . $produit['product_id'] . '</td>
                                   <td>' . $produit['product_type_description'] . '</td>
                                   <td>' . $produit['product_name'] . '</td>
                                   <td>' . $produit['product_description'] . '</td>
                                   <td>' . $produit['other_product_details'] . '</td>
                                   <td><a href="detailsproduct.html.php?product_id=' . $produit['product_id'] . '" class="btn btn-info">Voir les details</a></td>
                                   
                                   <form action="products.html.php" method="get"> 
                                   <td style="border: none;">
                                   <input type="submit" name="delete_Product" value="Supprimer" class="btn btn-danger" onclick="return confirm(\'Etes vous sûre de vouloir supprimer cet article ?\');">
                                   <input type="hidden" name="hiddenDeleteProduct" value="' . $produit['product_id'] . '">                                   
                                   </td>
                                   </form>
                               </tr>
                            ');
                }
                ?>
                </tbody>
            </table>
        </section>
    </div>
</main>