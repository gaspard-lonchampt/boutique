<?php
session_start();
require_once 'nav.html.php';
$repere = 1;
require_once '../../autoload.php';


$Produits = new \Models\Products();
$item = new \Models\Categories();

/**
 * Modifier le produit;
 */
$Produits->updateproduct();


/**
 * UPDATE IMAGE ICI (1 et 2 en deux if séparé)
 */
$Produits->updateimage();

/**
 * POUR SUPPRIMER UN STOCK
 */
if (isset($_GET['delete_Stock']))
{
    $Produits->deleteStock($_GET['hiddenDeleteInventaire']);
}

/**
 * On va faire afficher les détails d'un produit, incluant l'image
 */
$Produits->displayproducts();
?>
<main class="container">
    <div class="row">
        <section class="col-12">

            <!-- MESSAGE D ERREUR -->
            <?php
            if (!empty($_SESSION['erreur'])) {
                echo '<div class="alert alert-danger" role="alert">' . $_SESSION['erreur'] . '</div>';
                $_SESSION['erreur'] ="";
            }
            ?>
            <!-- FIN MESSAGE D ERREUR -->

            <!-- MESSAGE POUR PRODUIT UPDATE -->
            <?php
            if (!empty($_SESSION['message'])) {
                echo '<div class="alert alert-success" role="alert">' . $_SESSION['message'] . '</div>';
                $_SESSION['message'] ="";
            }
            ?>
            <!-- FIN MESSAGE -->


            <h1>Détails du produit <?= $_SESSION['product']['product_name'] ?></h1>

            <a href="products.html.php" class="btn btn-secondary">Retour</a> <br><br>

            <!-- AFFICHAGE INFO PRODUIT -->
            <p>ID: <?= $_SESSION['product']['product_id'] ?></p>
            <p>Type de produit: <?= $_SESSION['product']['product_type_description'] ?></p>
            <p>Description: <?= $_SESSION['product']['product_description'] ?></p>
            <p>Détails: <?= $_SESSION['product']['other_product_details'] ?></p>

            <!-- IMAGE PRODUIT -->
            <?php
            if (!empty($_SESSION['product']['product_image_1'])) {
                ?>
                <img src="../images/<?= $_SESSION['product']['product_image_1']?>" />
                <?php
            }
            ?>
            <?php
            if (!empty($_SESSION['product']['product_image_2'])) {
                ?>
                <img src="../images/<?= $_SESSION['product']['product_image_2']?>" />
                <?php
            }
            ?>
            <!-- FIN AFFICHAGE INFO PRODUIT -->

            <!-- FORM POUR LE BOUTON MODIFIER -->
            <form method="POST">
                <input type="submit" name="updateProduct" value="Modifer le produit" class="btn btn-warning">
            </form>
            <!-- FIN DE FORM BOUTON MODIFIER -->

            <?php
            /**
             * AFFICHAGE DU FORM POUR UPDATE PRODUIT
             */
            if (isset($_POST['updateProduct'])) {
                ?>
                <!-- MODIFIER PRODUIT-->
                <form method="post">
                    <div class="form-group">
                        <label for="attribut">Type de produit</label>
                        <select name="product_type_id" id="product_type_id" class="form-control">
                            <?php
                            $allCat = $item->findAllCategories();
                            foreach ($allCat as $cat)
                            {
                                echo ('<option value="' . $cat['product_type_id'] . '"> type : ' . $cat['product_type_description'] . '</option>');
                            }?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="product_name">Nom du produit</label>
                        <input type="text" name="product_name" class="form-control" value="<?= $_SESSION['product']['product_name']?>">
                    </div>
                    <div class="form-group">
                        <label for="product_description">Description du produit</label>
                        <input type="text" name="product_description" class="form-control" value="<?= $_SESSION['product']['product_description']?>">
                    </div>
                    <div class="form-group">
                        <label for="other_product_details">Détail du produit</label>
                        <input type="text" name="other_product_details" class="form-control" value="<?= $_SESSION['product']['other_product_details']?>">
                    </div>
                    <input type="hidden" value="<?= $_SESSION['product']['product_id'] ?>" name="product_id">
                    <button name="modifierlesodonnees" class="btn btn-success" id="modifierlesodonnees">Modifier le produit</button>
                </form>
                <!-- FIN MODIFIER UN PRODUIT -->

                <!-- UPDATE IMAGE -->
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="photo">Photo de l'image 1 :</label>
                        <input type="file" class="form-control" name="photo" >
                    </div>
                    <input type="hidden" value="<?= $_SESSION['product']['product_id'] ?>" name="product_id">
                    <button name="updateimg1" class="btn btn-success" id="updateimg1">Modifier L'image 1</button>
                </form>
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="photo">Photo de l'image 2 :</label>
                        <input type="file" class="form-control" name="photo" >
                    </div>
                    <input type="hidden" value="<?= $_SESSION['product']['product_id'] ?>" name="product_id">
                    <button name="updateimg2" class="btn btn-success" id="updateimg2">Modifier L'image 2</button>
                </form>
                <!-- FIN UPDATE IMAGE -->
                <?php
            }
            ?>

            <!-- INVENTAIRE -->
            <table class="table">
                <thead>
                <th>TALLE</th>
                <th>COULEUR</th>
                <th>QUANTITE</th>
                <th>PRIX</th>
                </thead>
                <tbody>
                    <?php

                    $allStock = $Produits -> inventaire($_SESSION['product']['product_id']);
                    foreach ($allStock as $inventaire)
                    {
                        //var_dump($inventaire);
                        echo ('<tr>
                                    <td>' . $inventaire['attribute_size'] . '</td>
                                    <td>' . $inventaire['attribute_color'] . '</td>
                                    <td>' . $inventaire['quantity'] . '</td>
                                    <td>' . $inventaire['price'] . ' €</td>
                              
                                    <form method="POST">
                                        <td>
                                            <input type="submit" name="updateStock" value="Modifer quantité / prix" class="btn btn-warning">
                                            <input type="hidden" name="updateInventaire" value="' . $inventaire['stock_id'] . '">                                   
                                        </td>
                                    </form>
                                    <form method="GET">
                                        <td>
                                            <input type="submit" name="delete_Stock" value="Supprimer" class="btn btn-danger" onclick="return confirm(\'Etes vous sûre de vouloir supprimer de l inventaire ?\');">
                                            <input type="hidden" name="hiddenDeleteInventaire" value="' . $inventaire['stock_id'] . '">                                   
                                        </td>
                                   </form>');
                        ?>

                        <!-- UPDATE STOCK -->
                        <?php
                        /**
                         * AFFICHAGE DU FORM POUR UPDATE INVENTAIRE
                         */
                        if (isset($_POST['updateStock']) || isset($_POST['modifierlestock']))
                        {
                            /**
                             * Modifier l'inventaire';
                             */
                            $Produits->updateStock();
                            if (isset($_POST['updateStock']))
                            { ?>
                        <form method="post">
                            <div class="form-group">
                                <td>
                                <label for="attribut">Quantité</label>
                                <input type="number" name="quantite" id="quantite" value="<?= $inventaire['quantity'] ?>">
                                </td>
                            </div>
                            <div class="form-group">
                                <td>
                                <label for="product_name">Prix</label>
                                <input type="number" name="prix" value="<?= $inventaire['price']?>">
                                </td>
                            </div>
                            <td>
                            <input type="hidden" value="<?= $inventaire['stock_id']?>" name="stock_id">
                            <button name="modifierlestock" class="btn btn-success" id="">Modifier l'inventaire</button>
                            </td>
                        </form>
                        <!-- FIN UPDATE STOCK -->
                        <?php
                            }
                        }
                        echo ('</tr>');
                    } ?>
                </tbody>
            </table>
            <!-- FIN INVENTAIRE -->

            <!-- FORM POUR LE BOUTON AJOUTER -->
            <form method="POST">
                <input type="submit" name="addProduct" value="Ajouter un stock" class="btn btn-primary">
            </form>
            <!-- FIN DE FORM BOUTON AJOUTER-->

            <?php
            /**
             * AFFICHAGE DU FORM POUR Ajouter STOCK
             */
            if (isset($_POST['addProduct']) || (isset($_POST["addStock"]))) {
                ?>

                <!-- AJOUT DES STOCK -->
                <?php $Produits->insertstock();
                if (isset($_POST['addProduct']))
                { ?>
                <form method="post">
                    <div class="form-group">
                        <label for="attribut">COMBINAISON COULEUR/TAILLE</label>
                        <select name="attribut" id="attribut" class="form-control">
                        <?php

                        $allAttributs = $item->findAllAttribut();
                        foreach ($allAttributs as $attribut)
                        {
                            echo ('<option value="' . $attribut['attribute_value_id'] . '"> type : ' . $attribut['product_type_description'] . ', couleur : 
                                   ' . $attribut['attribute_color'] . ', taille : 
                                   ' . $attribut['attribute_size'] . '</option>');
                        }?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quantity">QUANTITE</label>
                        <input type="number" name="quantity" id="quantity" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="price">PRIX</label>
                        <input type="number" name="price" id="price" class="form-control" value="<?php echo $inventaire['price']; ?>">
                    </div>
                    <input type="hidden" name="product_id" id="product_id" value="<?= $_SESSION['product']['product_id'] ?>">
                    <button name="addStock" class="btn btn-success">Valider</button>
                </form>
                <!-- FIN AJOUT DES STOCK -->
                <?php
                }
            }
            ?>
        </section>
    </div>
</main>
