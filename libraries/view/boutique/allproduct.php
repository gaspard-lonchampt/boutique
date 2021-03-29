<?php
$repere = 1;
session_start();
require_once '../../autoload.php';
require_once 'layout_front.html.php';
require_once 'header.html.php';

$Produits = new \Models\Products();
$allProduits = $Produits->findAllProductsWithImages();
//var_dump($allProduits);
?>

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

<?php
require_once 'footer.html.php';
