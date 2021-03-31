<?php
$repere = 1;
require_once '../../autoload.php';
require_once 'layout_front.html.php';
require_once 'header.html.php';

$Produits = new \Models\Products();
$allProduits = $Produits->findProductWithImages();
?>
<main id="accueil">
    <div class="background-image01">
        <video autoplay="" loop="" id="bgvid">
            <source src="../videos/Mystery%20-%2038200.mp4" type="video/webm">
            <source src="../videos/Mystery%20-%2038200.mp4" type="video/mp4">
        </video>
        <H1>Les dernières <span>merch</span> de vos artistes</H1>
    </div>
    <div id="contentaccueil">
        <h2>Nos produits phares</h2>
        <div id="parent" style="background-color: #FAF9F5" >

            <?php
            foreach ($allProduits as $produit) {
                ?>
                <div class="child">

                    <div id="content-item">
                        <div class="titre">
                            <h2><?= $produit['product_name']; ?></h2>
                        </div>
                        <div class="image">
                            <a href="produit.php?product_id=<?= $produit['product_id'] ?>">
                                <img class="one" src="../images/<?= $produit['product_image_1']?>" alt="<?= $produit['product_name']; ?>"/>
                                <img class="two" src="../images/<?= $produit['product_image_2']?>" alt="<?= $produit['product_name']; ?>"/>
                            </a>
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
        <div id="voirproduit">
            <button id="btnaccueil"><a href="allproduct.php">Voir tous les articles</a></button>
        </div>

        <div class="background-image02">
        </div>

        <div id="artisteaccueil">
            <p>Mac Miller</p>
            <p>BTS</p>
            <p>Suicidal Tendencies</p>
            <p>Tyler the creator : GOLF WANG</p>
            <p>SchoolBoy</p>
        </div>

    </div>
</main>

<?php
require_once 'footer.html.php';
