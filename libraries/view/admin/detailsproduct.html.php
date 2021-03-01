<?php
session_start();
require_once '../../../template/layout.html.php';
require_once '../../../libraries/models/Products.php';
require_once '../../../libraries/models/Categories.php';

$Produits = new Products();
$item = new Categories();


/**
 * On va modifer les données ici
 */
if (isset($_POST['modifierlesodonnees'])) {
    if (isset($_POST['product_id']) && !empty($_POST['product_id'])
        && isset($_POST['product_type_id']) && !empty($_POST['product_type_id'])
        && isset($_POST['product_name']) && !empty($_POST['product_name'])
        && isset($_POST['product_description']) && !empty($_POST['product_description'])
        && isset($_POST['other_product_details']) && !empty($_POST['other_product_details'])) {
        //connexion à la base de données
        $pdo = new PDO('mysql:host=localhost;dbname=boutique;charset=utf8', 'root', '', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);

        $id = strip_tags($_POST["product_id"]);
        $type = strip_tags($_POST["product_type_id"]);
        $nom = strip_tags($_POST["product_name"]);
        $description = strip_tags($_POST["product_description"]);
        $other = strip_tags($_POST["other_product_details"]);

        $sql = "UPDATE `products` SET `product_type_id`=:product_type_id, `product_name`=:product_name, `product_description`=:product_description, `other_product_details`=:other_product_details WHERE product_id=:product_id";
        $query = $pdo->prepare($sql);
        //var_dump($query);
        $query->bindValue(':product_id', $id, PDO::PARAM_INT);
        $query->bindValue(':product_type_id', $type, PDO::PARAM_INT);
        $query->bindValue(':product_name', $nom, PDO::PARAM_STR);
        $query->bindValue(':product_description', $description, PDO::PARAM_STR);
        $query->bindValue(':other_product_details', $other, PDO::PARAM_STR);
        $query->execute();

        $_SESSION['message'] = "Le produit a été modifié";

    } else {
        $_SESSION['erreur'] = "le formulaire n'est pas complet";
    }
}

/**
 * UPDATE IMAGE ICI (1 et 2 en deux if séparé)
 */
if (isset($_POST['updateimg1']))
{
    //Vérification que ce ne soit pas vide
    if (isset($_FILES['photo']) && !empty($_FILES['photo']['name']))
    {
        //On définit la taille de l'image
        $tailleMax = 2097152;
        //On définit les formats valides
        $extensionsValide = ['jpg', 'jpeg', 'gif', 'png'];

        if ($_FILES['photo']['size'] <= $tailleMax)
        {
            //on renvoie l'enxtension du fichier avec '.' devant = strrchr
            //on va venir ignorer le 1er charactère la chaine = substr : 1
            //on met tout en minuscule = strtolower
            $extensionsUpload = strtolower(substr(strrchr($_FILES['photo']['name'],'.'),1));
            if (in_array($extensionsUpload, $extensionsValide))
            {
                //on détermine où les photos seront upload
                $chemin = "../images/" . $_POST['product_id'] . "." . $extensionsUpload;
                //on va les placer dans le bon dossier
                $deplacement = move_uploaded_file($_FILES['photo']['tmp_name'], $chemin);

                if ($deplacement)
                {
                    $pdo = new PDO('mysql:host=localhost;dbname=boutique;charset=utf8', 'root', '', [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]);
                    $sql = "UPDATE `products_image` SET `product_image_1` = :product_image_1 WHERE product_id = :product_id";
                    $updateAvatar = $pdo->prepare($sql);
                    $updateAvatar->bindValue(':product_id', $_POST['product_id'], PDO::PARAM_INT);
                    $updateAvatar->bindValue(':product_image_1', $_POST['product_id'] . "." . $extensionsUpload);
                    $updateAvatar->execute();
                }
                else {
                    $_SESSION['erreur'] = "Erreur durant l'importation de la photo";
                }
            }
            else {
                $_SESSION['erreur'] = "La photo doit être au format : jpg, jpeg, gif, png.";
            }
        }
        else {
            $_SESSION['erreur'] = "L'image est trop lourde, 2Mo maximum";
        }
    }
}
if (isset($_POST['updateimg2']))
{
    //Vérification que ce ne soit pas vide
    if (isset($_FILES['photo']) && !empty($_FILES['photo']['name']))
    {
        //On définit la taille de l'image
        $tailleMax = 2097152;
        //On définit les formats valides
        $extensionsValide = ['jpg', 'jpeg', 'gif', 'png'];

        if ($_FILES['photo']['size'] <= $tailleMax)
        {
            //on renvoie l'enxtension du fichier avec '.' devant = strrchr
            //on va venir ignorer le 1er charactère la chaine = substr : 1
            //on met tout en minuscule = strtolower
            $extensionsUpload = strtolower(substr(strrchr($_FILES['photo']['name'],'.'),1));
            if (in_array($extensionsUpload, $extensionsValide))
            {
                //on détermine où les photos seront upload
                $chemin = "../images/" . $_POST['product_id'] . "-2." . $extensionsUpload;
                //on va les placer dans le bon dossier
                $deplacement = move_uploaded_file($_FILES['photo']['tmp_name'], $chemin);

                if ($deplacement)
                {
                    $pdo = new PDO('mysql:host=localhost;dbname=boutique;charset=utf8', 'root', '', [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]);
                    $sql = "UPDATE `products_image` SET `product_image_2` = :product_image_2 WHERE product_id = :product_id";
                    $updateAvatar = $pdo->prepare($sql);
                    $updateAvatar->bindValue(':product_id', $_POST['product_id'], PDO::PARAM_INT);
                    $updateAvatar->bindValue(':product_image_2', $_POST['product_id'] . "-2." . $extensionsUpload);
                    $updateAvatar->execute();
                }
                else {
                    $_SESSION['erreur'] = "Erreur durant l'importation de la photo";
                }
            }
            else {
                $_SESSION['erreur'] = "La photo doit être au format : jpg, jpeg, gif, png.";
            }
        }
        else {
            $_SESSION['erreur'] = "L'image est trop lourde, 2Mo maximum";
        }
    }
}


/**
 * ON va faire afficher les détails d'un produit, incluant l'image
 */

// Est-ce qu'il existe et n'est pas vide dans l'url?
if (isset($_GET['product_id']) && !empty($_GET['product_id'])) {

    //connexion à la base de données
    $pdo = new PDO('mysql:host=localhost;dbname=boutique;charset=utf8', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    // On nettoie l'id envoyé
    $product_id = strip_tags($_GET['product_id']);

    $sql = 'SELECT `product_id`, product_type_description, `product_name`, `product_description`, `other_product_details`, product_image_1, product_image_2 FROM `products` NATURAL JOIN ref_product_types NATURAL JOIN products_image WHERE product_id = :product_id';

    //On prépare requête
    $query = $pdo->prepare($sql);

    //On accroches les paramètres
    $query->bindValue(':product_id', $product_id, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();

    // On récupère le produit
    $produit = $query->fetch();

    //on definit une session
    $_SESSION['product_id'] = $produit['product_id'];

    /**  ca marchait, mais ça marche plus ¯\_(ツ)_/¯
     * ça n'affiche pas la fiche produit meme si elle existe
    // On vérifie si le produit existe
    if (!$produit){
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: products.html.php');
    }
     */
} else {
    $_SESSION['erreur'] = "URL invalide";
    header('Location: products.html.php');
}
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


            <h1>Détails du produit <?= $produit['product_name'] ?></h1>

            <a href="products.html.php" class="btn btn-secondary">Retour</a> <br><br>

            <!-- AFFICHAGE INFO PRODUIT -->
            <p>ID: <?= $produit['product_id'] ?></p>
            <p>Type de produit: <?= $produit['product_type_description'] ?></p>
            <p>Description: <?= $produit['product_description'] ?></p>
            <p>Détails: <?= $produit['other_product_details'] ?></p>

            <!-- IMAGE PRODUIT -->
            <?php
            if (!empty($produit['product_image_1'])) {
                ?>
                <img src="../images/<?= $produit['product_image_1']?>" />
                <?php
            }
            ?>
            <?php
            if (!empty($produit['product_image_2'])) {
                ?>
                <img src="../images/<?= $produit['product_image_2']?>" />
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
                        <label for="product_type_id">Type de produit</label>
                        <input type="number" name="product_type_id" class="form-control" value="<?= $produit['product_type_id']?>">
                    </div>
                    <div class="form-group">
                        <label for="product_name">Nom du produit</label>
                        <input type="text" name="product_name" class="form-control" value="<?= $produit['product_name']?>">
                    </div>
                    <div class="form-group">
                        <label for="product_description">Description du produit</label>
                        <input type="text" name="product_description" class="form-control" value="<?= $produit['product_description']?>">
                    </div>
                    <div class="form-group">
                        <label for="other_product_details">Détail du produit</label>
                        <input type="text" name="other_product_details" class="form-control" value="<?= $produit['other_product_details']?>">
                    </div>
                    <input type="hidden" value="<?= $produit['product_id']?>" name="product_id">
                    <button name="modifierlesodonnees" class="btn btn-success" id="modifierlesodonnees">Modifier le produit</button>
                </form>
                <!-- FIN MODIFIER UN PRODUIT -->

                <!-- UPDATE IMAGE -->
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="photo">Photo de l'image 1 :</label>
                        <input type="file" class="form-control" name="photo" >
                    </div>
                    <input type="hidden" value="<?= $produit['product_id']?>" name="product_id">
                    <button name="updateimg1" class="btn btn-success" id="updateimg1">Modifier L'image 1</button>
                </form>
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="photo">Photo de l'image 2 :</label>
                        <input type="file" class="form-control" name="photo" >
                    </div>
                    <input type="hidden" value="<?= $produit['product_id']?>" name="product_id">
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

                    $allStock = $Produits -> inventaire($_SESSION['product_id']);
                    foreach ($allStock as $inventaire)
                    {
                        var_dump($inventaire);
                        echo ('<tr>
                                    <td>' . $inventaire['attribute_size'] . '</td>
                                    <td>' . $inventaire['attribute_color'] . '</td>
                                    <td>' . $inventaire['quantity'] . '</td>
                                    <td>' . $inventaire['price'] . '</td>
                              
                                    <form method="get">
                                        <td style="border: none;">
                                            <input type="submit" name="updateStock" value="Modifer le stock" class="btn btn-warning">
                                            <input type="hidden" name="updateInventaire" value="' . $inventaire['product_id'] . '">                                   
                                        </td>
                                   </form>
                              </tr>');
                    }
                    ?>
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
             * AFFICHAGE DU FORM POUR UPDATE PRODUIT
             */
            if (isset($_POST['addProduct'])) {
                ?>

                <!-- AJOUT DES STOCK -->
                <!--  -->
                <?php $Produits->insertstock(); ?>
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
                        <input type="number" name="quantity" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="price">PRIX</label>
                        <input type="number" name="price" class="form-control" value="<?php echo $inventaire['price']; ?>">
                    </div>
                    <input type="hidden" value="<?= $_SESSION['product_id'] ?>">
                    <button name="addStock" class="btn btn-success">Valider</button>
                </form>
                <!-- FIN AJOUT DES STOCK -->
                <?php
            }
            ?>
        </section>
    </div>
</main>
