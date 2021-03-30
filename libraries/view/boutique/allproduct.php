<?php
$repere = 1;
require_once '../../autoload.php';
require_once 'layout_front.html.php';
require_once 'header.html.php';

$Produits = new \Models\Products();
$allProduits = $Produits->findAllProductsWithImages();
$Categories = new \Models\Categories();
//var_dump($allProduits);
if(isset($_GET['searchitem'])) {

    $tab = array();

    foreach ($_GET as $value){
        if ($value != 'Filtrer')
        array_push($tab, $value);
    }
    var_dump($_GET);
    //var_dump($_GET);
    $allsearchProduits = $Produits->filtre($tab);

}
if (isset($_GET['voir'])) {
    header('location:allproduct.php');
}
?>

<div class="grid-container">
    <div class="filtre">
        <h3>FILTRES :</h3>
        <form method="get" action="">
            <section id="categoriefiltre">
                <h4>Catégories</h4>
                <p>
                <?php
                $allCat = $Categories->findAllCategories();
                foreach ($allCat as $cat)
                {
                    if ($cat['product_type_description'] == 'APPAREL')
                        echo '';
                    else
                    echo ('<input type="checkbox" id="scales" name="category' . $cat['product_type_description'] . '" value="' . $cat['product_type_description'] . '"> <label for="' . $cat['product_type_description'] . '">' . $cat['product_type_description'] . '</label> <br>');
                }?></p>
            </section>
            <section id="artistefiltre">
                <h4>Artistes</h4>
                <p><?php
                $ALLartistes = $Produits->displayartistefiltre();
                foreach ($ALLartistes as $artiste)
                {
                    //var_dump($artiste);
                    echo ('<input type="checkbox" id="scales" name="artiste' . $artiste['other_product_details'] . '" value="' . $artiste['other_product_details'] . '"> <label for="' . $artiste['other_product_details'] . '">' . $artiste['other_product_details'] . '</label> <br>');
                }?></p>
            </section>
            <section id="couleurfiltre">
                <h4>Couleurs</h4>
                <p><?php
                $ALLcouleur = $Produits->displaycouleurfiltre();
                foreach ($ALLcouleur as $couleur)
                {
                    //var_dump($artiste);
                    if ($couleur['attribute_color'] == 'DEFAULT')
                        echo '';
                    else
                    echo ('<input type="checkbox" id="scales" name="couleur' . $couleur['attribute_color'] . '" value="' . $couleur['attribute_color'] . '"> <label for="' . $couleur['attribute_color'] . '">' . $couleur['attribute_color'] . '</label> <br>');
                }?></p>
            </section>
            <section id="taillefiltre">
                <h4>Taille</h4>
                <p><?php
                $ALLtailles = $Produits->displaytaillefiltre();
                foreach ($ALLtailles as $taille)
                {
                    //var_dump($artiste);
                    if ($taille['attribute_size'] == 'DEFAULT')
                        echo '';
                    else
                    echo ('<input type="checkbox" id="scales" name="taille' . $taille['attribute_size'] . '" value="' . $taille['attribute_size'] . '"> <label for="' . $taille['attribute_size'] . '">' . $taille['attribute_size'] . '</label> <br>');
                }?></p>
            </section>
            <input type='submit' value="Filtrer" name="searchitem">
        </form>
    </div>
    <?php
        if (!isset($_GET['searchitem'])) {
    ?>
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
            <?php
            }
        else {
            ?>
            <div class="parent" style="margin-top: 30px">
                <form method="get" action="allproduct.php">
                    <input type="submit" id="voir" name="voir" value="<-- Voir tous les produits">
                </form>
                <?php
                foreach ($allsearchProduits as $produit) {
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
            <?php
        }
            ?>
</div>

<?php
require_once 'footer.html.php';
