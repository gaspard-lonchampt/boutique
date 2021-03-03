<?php
session_start();
require_once 'nav.html.php';
require_once '../../../template/layout.html.php';
require_once '../../../libraries/models/Categories.php';

$item = new Categories();
?>
<?php
/**
 * POUR SUPPRIMER
 */
if (isset($_GET['delete_Cat']))
{
    $item->deleteCat($_GET['hiddenDeleteCat']);
}
?>
<?php
if (isset($_GET['delete_Attribut']))
{
    $item->deleteAtt($_GET['hiddenDeleteAttribut']);
}
?>
<main class="container">
    <div class="row">
        <h1>Categories et attributs des Produits</h1>

        <section class="col-12">

            <!-- MESSAGE D ERREUR-->
            <?php
            if (!empty($_SESSION['erreur'])) {
                echo '<div class="alert alert-danger" role="alert">' . $_SESSION['erreur'] . '</div>';
                $_SESSION['erreur'] ="";
            }
            ?>
            <!-- FIN MESSAGE D ERREUR -->

            <!-- MESSAGE-->
            <?php
            if (!empty($_SESSION['message'])) {
                echo '<div class="alert alert-success" role="alert">' . $_SESSION['message'] . '</div>';
                $_SESSION['message'] ="";
            }
            ?>
            <!-- FIN MESSAGE -->

            <!-- GESTION DES CATEGORIES -->
            <h2>Catégories</h2>

            <!-- FORM POUR LE BOUTON AJOUTER -->
            <form method="POST">
                <input type="submit" name="readADDcat" value="Ajouter une Catégorie" class="btn btn-primary">
            </form>
            <!-- FIN DE FORM BOUTON AJOUTER-->
            <?php
            /**
             * AFFICHAGE DU FORM POUR AJOUT CAT
             */
            if (isset($_POST['readADDcat']) || isset($_POST["addCat"])) {
                ?>
                <!-- AJOUT DES Categories -->
                <?php $item->insertCat();
                if (isset($_POST['readADDcat']))
                { ?>
                    <form action="categories-attribute.html.php" method="post">
                        <div class="form-group">
                            <label for="parent_product_type_code">Parent du produit</label>
                            <select name="parent_product_type_code" id="parent_product_type_code" class="form-control">
                                <option value="1" selected>1 - Apparel</option>
                                <option value="2">2 - Music</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="product_type_description">Description</label>
                            <input type="text" id="product_type_description" name="product_type_description" class="form-control" value="lol">
                        </div>
                        <button type="submit" name="addCat" class="btn btn-success">Valider</button>
                    </form>
                    <!-- FIN AJOUT DES CAT -->
                    <?php
                }
            }
            ?>


            <!-- AFFICHAGE DU TABLEAU AVEC Catégories -->
            <table class="table">
                <thead>
                <th>ID</th>
                <th>Parent type</th>
                <th>Description</th>
                </thead>
                <tbody>
                <?php

                $allCategogies = $item->findAllCategories();

                foreach ($allCategogies as $categogy)
                {
                    echo ('<tr>
                                   <td>' . $categogy['product_type_id'] . '</td>
                                   <td>' . $categogy['parent_product_type_code'] . '</td>
                                   <td>' . $categogy['product_type_description'] . '</td>
                                   
                                   <form action="" method="get"> 
                                   <td style="border: none;">
                                   <input type="submit" name="delete_Cat" value="Supprimer" class="btn btn-danger" onclick="return confirm(\'Etes vous sûre de vouloir supprimer ?\');">
                                   <input type="hidden" name="hiddenDeleteCat" value="' . $categogy['product_type_id'] . '">                                   
                                   </td>
                                   </form>
                               </tr>');
                }
                ?>
                </tbody>
            </table>

            <h2>Attributs</h2>

            <!-- FORM POUR LE BOUTON AJOUTER -->
            <form method="POST">
                <input type="submit" name="readADDatt" value="Ajouter un Attribut" class="btn btn-primary">
            </form>
            <!-- FIN DE FORM BOUTON AJOUTER-->
            <?php
            /**
             * AFFICHAGE DU FORM POUR AJOUT ATTRIBUT
             */
            if (isset($_POST['readADDatt']) || isset($_POST["addAtt"])) {
                ?>
                <!-- AJOUT DES Attribut -->
                <?php $item->insertAtt();
                if (isset($_POST['readADDatt']))
                { ?>
                    <form action="categories-attribute.html.php" method="post">
                        <div class="form-group">
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
                            <label for="attribute_color">Couleur</label>
                            <select name="attribute_color" id="attribute_color" class="form-control">
                                <option value="NOIR" selected>NOIR</option>
                                <option value="GRIS">GRIS</option>
                                <option value="BLEU">BLEU</option>
                                <option value="ROUGE">ROUGE</option>
                                <option value="JAUNE">JAUNE</option>
                                <option value="VERT">VERT</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="attribute_size">Taille</label>
                            <select name="attribute_size" id="attribute_size" class="form-control">
                                <option value="1 - XS" selected>XS</option>
                                <option value="2 - S">S</option>
                                <option value="3 - M">M</option>
                                <option value="4 - L">L</option>
                                <option value="5 - XL">XL</option>
                                <option value="6 -XXL">XXL</option>
                                <option value="7 -XXXL">XXXL</option>
                            </select>
                        </div>
                        <button type="submit" name="addAtt" class="btn btn-success">Valider</button>
                    </form>
                    <!-- FIN AJOUT DES CAT -->
                    <?php
                }
            }
            ?>

            <!-- AFFICHAGE DU TABLEAU AVEC Attribut -->
            <table class="table">
                <thead>
                <th>ID </th>
                <th>Produit</th>
                <th>Couleur</th>
                <th>Taille</th>
                </thead>
                <tbody>
                <?php

                $allAttributs = $item->findAllAttribut();

                foreach ($allAttributs as $attribut)
                {
                    //var_dump($attribut);
                    echo ('<tr>
                                   <td>' . $attribut['attribute_value_id'] . '</td>
                                   <td>' . $attribut['product_type_description'] . '</td>
                                   <td>' . $attribut['attribute_color'] . '</td>
                                   <td>' . $attribut['attribute_size'] . '</td>
                                   
                                   <form action="" method="get"> 
                                   <td style="border: none;">
                                   <input type="submit" name="delete_Attribut" value="Supprimer" class="btn btn-danger" onclick="return confirm(\'Etes vous sûre de vouloir supprimer ?\');">
                                   <input type="hidden" name="hiddenDeleteAttribut" value="' . $attribut['attribute_value_id'] . '">                                   
                                   </td>
                                   </form>
                               </tr>
                            ');
                }?>
                </tbody>
            </table>
        </section>
    </div>
</main>