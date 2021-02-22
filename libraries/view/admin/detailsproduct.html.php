<?php
session_start();
require_once '../../../template/layout.html.php';
require_once '../../../libraries/models/Products.php';


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
        header('Location: products.html.php');

    } else {
        $_SESSION['erreur'] = "le formulaire n'est pas complet";
    }
}



/**
 * ON va faire afficher les détails d'un produit
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

    $sql = 'SELECT * FROM `products` WHERE product_id = :product_id;';

    //On prépare requête
    $query = $pdo->prepare($sql);

    //On accroches les paramètres
    $query->bindValue(':product_id', $product_id, PDO::PARAM_INT);

    // On exécute la requête

    $query->execute();

    // On récupère le produit
    $produit = $query->fetch();

    // On vérifie si le produit existe

    if (!$produit){
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: products.html.php');
    }
} else {
    $_SESSION['erreur'] = "URL invalide";
    header('Location: products.html.php');
}
?>
<main class="container">
    <div class="row">
        <section class="col-12">
            <h1>Détails du produit <?= $produit['product_name'] ?></h1>
            <p>ID: <?= $produit['product_id'] ?></p>
            <p>Type de produit: <?= $produit['product_type_id'] ?></p>
            <p>Description: <?= $produit['product_description'] ?></p>
            <p>Détails: <?= $produit['other_product_details'] ?></p>
            <a href="products.html.php">Retour</a>
        </section>

        <!-- MODIFIER DE PRODUIT
        <a href="" class="btn btn-primary">Modifier un produit</a>-->

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
            <button name="modifierlesodonnees" class="btn btn-primary" id="modifierlesodonnees">Valider !</button>
        </form>
        <!-- FIN MODIFIER UN PRODUIT -->
    </div>
</main>
