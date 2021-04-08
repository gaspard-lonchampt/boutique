<?php
$index = 1;
require_once 'libraries/autoload.php';
require_once 'libraries/view/boutique/layout_front.html.php';
require_once 'libraries/view/boutique/header.html.php';

$Produits = new \Models\Products();
$allProduits = $Produits->findProductWithImages();
$allMusic = $Produits->findMusic();
$allProduit =$Produits->findProduit();
?>
<main id="accueil">
    <div class="background-image01">
        <video autoplay="" loop="" id="bgvid">
            <source src="libraries/view/videos/Mystery%20-%2038200.mp4" type="video/webm">
            <source src="libraries/view/videos/Mystery%20-%2038200.mp4" type="video/mp4">
        </video>
        <H1>Les dernières <span>merch</span> de vos artistes</H1>
    </div>
    <div id="contentaccueil">
        <h2 class="h2">Nos produits phares</h2>
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
                            <a href="libraries/view/boutique/produit.php?product_id=<?= $produit['product_id'] ?>">
                                <img class="one" src="libraries/view/images/<?= $produit['product_image_1']?>" alt="<?= $produit['product_name']; ?>"/>
                                <img class="two" src="libraries/view/images/<?= $produit['product_image_2']?>" alt="<?= $produit['product_name']; ?>"/>
                            </a>
                        </div>
                        <div class="other">
                            <h3><?= $produit['other_product_details']; ?></h3>
                        </div>
                        <div class="price">
                            <h3><?= $produit['price']; ?> €</h3>
                        </div>
                        <div class="bouton1">
                            <a href="libraries/view/boutique/produit.php?product_id=<?= $produit['product_id'] ?>">Voir le produit</a>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <div id="voirproduit">
            <button id="btnaccueil"><a href="libraries/view/boutique/allproduct.php">Voir tous les articles</a></button>
        </div>

        <div class="background-image02 bgc002">
        </div>
        <h2 class="h2">Notre selection Music</h2>
        <div id="parent" style="background-color: #FAF9F5" >

            <?php
            foreach ($allMusic as $produit) {
                ?>
                <div class="child">

                    <div id="content-item">
                        <div class="titre">
                            <h2><?= $produit['product_name']; ?></h2>
                        </div>
                        <div class="image">
                            <a href="libraries/view/boutique/produit.php?product_id=<?= $produit['product_id'] ?>">
                                <img class="one" src="libraries/view/images/<?= $produit['product_image_1']?>" alt="<?= $produit['product_name']; ?>"/>
                                <img class="two" src="libraries/view/images/<?= $produit['product_image_2']?>" alt="<?= $produit['product_name']; ?>"/>
                            </a>
                        </div>
                        <div class="other">
                            <h3><?= $produit['other_product_details']; ?></h3>
                        </div>
                        <div class="price">
                            <h3><?= $produit['price']; ?> €</h3>
                        </div>
                        <div class="bouton1">
                            <a href="libraries/view/boutique/produit.php?product_id=<?= $produit['product_id'] ?>">Voir le produit</a>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <div id="voirproduit">
            <button id="btnaccueil"><a href="libraries/view/boutique/allproduct.php">Voir tous les articles</a></button>
        </div>

        <div class="background-image02 bgc001">
        </div>

        <h2 class="h2">Notre selection Merch</h2>
        <div id="parent" style="background-color: #FAF9F5" >

            <?php
            foreach ($allProduit as $produit) {
                ?>
                <div class="child">

                    <div id="content-item">
                        <div class="titre">
                            <h2><?= $produit['product_name']; ?></h2>
                        </div>
                        <div class="image">
                            <a href="libraries/view/boutique/produit.php?product_id=<?= $produit['product_id'] ?>">
                                <img class="one" src="libraries/view/images/<?= $produit['product_image_1']?>" alt="<?= $produit['product_name']; ?>"/>
                                <img class="two" src="libraries/view/images/<?= $produit['product_image_2']?>" alt="<?= $produit['product_name']; ?>"/>
                            </a>
                        </div>
                        <div class="other">
                            <h3><?= $produit['other_product_details']; ?></h3>
                        </div>
                        <div class="price">
                            <h3><?= $produit['price']; ?> €</h3>
                        </div>
                        <div class="bouton1">
                            <a href="libraries/view/boutique/produit.php?product_id=<?= $produit['product_id'] ?>">Voir le produit</a>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <div id="voirproduit">
            <button id="btnaccueil"><a href="libraries/view/boutique/allproduct.php">Voir tous les articles</a></button>
        </div>

        <div id="artisteaccueil">
            <p>Mac Miller</p>
            <p>BTS</p>
            <p>Suicidal Tendencies</p>
            <p>Tyler the creator : GOLF WANG</p>
            <p>SchoolBoy Q</p>
        </div>

    </div>
</main>

<?php
require_once 'libraries/view/boutique/footer.html.php';
