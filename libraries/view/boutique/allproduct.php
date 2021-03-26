<?php
session_start();
$repere = 1;
require_once '../../autoload.php';
$Produits = new \Models\Products();
$allProduits = $Produits->findAllProductsWithImages();
//var_dump($allProduits);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Espace Admin -</title>

    <link rel="stylesheet" href="allproduct.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Average&family=Fjalla+One&display=swap" rel="stylesheet">
</head>
<body>
    <div class="grid-container">
        <div class="filtre">
            filtres
        </div>
        <div class="parent">
            <?php
            foreach ($allProduits as $produit) {
            ?>
                <div class="child">
                    <div class="image">
                        <a href="produit.php?product_id=<?= $produit['product_id'] ?>">
                            <img class="one" src="../images/<?= $produit['product_image_1']?>" alt="<?= $_SESSION['product']['product_name']; ?>"/>
                            <img class="two" src="../images/<?= $produit['product_image_2']?>" alt="<?= $_SESSION['product']['product_name']; ?>"/>
                        </a>
                    </div>
                    <div id="content-item">
                        <div class="titre">
                            <h2><?= $produit['product_name']; ?></h2>
                        </div>
                        <div class="other">
                            <h3><?= $produit['other_product_details']; ?></h3>
                        </div>
                        <div class="price">
                            <h3><?= $produit['price']; ?> €</h3>
                        </div>
                        <div class="bouton1">
                            <a href="produit.php?product_id=<?= $produit['product_id'] ?>">Voir le produit</a>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</body>
</html>
