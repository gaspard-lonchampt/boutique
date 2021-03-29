<?php
$repere = 1;
require_once '../../autoload.php';
require_once 'layout_front.html.php';
require_once 'header.html.php';

$Produits = new \Models\Products();
$allProduits = $Produits->findAllProductsWithImages();
$Categories = new \Models\Categories();
//var_dump($allProduits);
?>

<div class="grid-container">
    <div class="filtre">
        <h3>FILTRES</h3>
        <form method="get" action="">
            <section id="categoriefiltre">
                <p>Catégories</p>
                <?php
                $allCat = $Categories->findAllCategories();
                foreach ($allCat as $cat)
                {
                    if ($cat['product_type_description'] == 'APPAREL' || $cat['product_type_description'] == 'MUSIC')
                        echo '';
                    else
                    echo ('<input type="checkbox" id="scales" name="' . $cat['product_type_description'] . '"> <label for="' . $cat['product_type_description'] . '">' . $cat['product_type_description'] . '</label> <br>');
                }?>
            </section>
            <section id="artistefiltre">
                <p>Artistes</p>
                <?php
                $ALLartistes = $Produits->artistefiltre();
                foreach ($ALLartistes as $artiste)
                {
                    //var_dump($artiste);
                    echo ('<input type="checkbox" id="scales" name="' . $artiste['other_product_details'] . '"> <label for="' . $artiste['other_product_details'] . '">' . $artiste['other_product_details'] . '</label> <br>');
                }?>
            </section>
            <section id="couleurfiltre">
                <p>Couleurs</p>
                <?php
                $ALLcouleur = $Produits->couleurfiltre();
                foreach ($ALLcouleur as $couleur)
                {
                    //var_dump($artiste);
                    if ($couleur['attribute_color'] == 'DEFAULT')
                        echo '';
                    else
                    echo ('<input type="checkbox" id="scales" name="' . $couleur['attribute_color'] . '"> <label for="' . $couleur['attribute_color'] . '">' . $couleur['attribute_color'] . '</label> <br>');
                }?>
            </section>
            <section id="taillefiltre">
                <p>Taille</p>
                <?php
                $ALLtailles = $Produits->taillefiltre();
                foreach ($ALLtailles as $taille)
                {
                    //var_dump($artiste);
                    if ($taille['attribute_size'] == 'DEFAULT')
                        echo '';
                    else
                    echo ('<input type="checkbox" id="scales" name="' . $taille['attribute_size'] . '"> <label for="' . $taille['attribute_size'] . '">' . $taille['attribute_size'] . '</label> <br>');
                }?>
            </section>
            <input type='submit' value="Filtrer" name="searchitem">
        </form>
    </div>
    <div class="parent">
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
                            <img class="one" src="../images/<?= $produit['product_image_1']?>" alt="<?= $_SESSION['product']['product_name']; ?>"/>
                            <img class="two" src="../images/<?= $produit['product_image_2']?>" alt="<?= $_SESSION['product']['product_name']; ?>"/>
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
</div>

<?php
require_once 'footer.html.php';
