<?php
$repere = 1;
require_once '../../autoload.php';
require_once 'layout_front.html.php';
require_once 'header.html.php';

$Produits = new \models\Products();
$allProduits = $Produits->findAllProductsWithImages();
$Categories = new \models\Categories();
//var_dump($allProduits);
if(isset($_GET['searchitem'])) {

    $tab = array();

    foreach ($_GET as $value){
        if ($value != 'Filtrer')
        array_push($tab, $value);
    }
    //var_dump($_GET);
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
            <input type='submit' value="Filtrer" name="searchitem">
        </form>
    </div>



    <!--nav bar search-->
    <?php
    if (isset($_GET['navbarseach'])) {
    ?>
    <div class="parent" style="margin-top: 30px">
        <form method="get" action="allproduct.php">
            <input type="submit" id="voir" name="voir" value="<-- Voir tous les produits">
        </form>
        <?php
        foreach ($navbarsearchProduits as $produit) {
            ?>
            <div class="child card">

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
    <?php
    }
    if (isset($_GET['searchitem'])) {
    ?>
            <!--catégorie search-->
        <div class="parent" style="margin-top: 30px">
            <form method="get" action="allproduct.php">
                <input type="submit" id="voir" name="voir" value="<-- Voir tous les produits">
            </form>
            <?php
            foreach ($allsearchProduits as $produit) {
                ?>
                <div class="child card">

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
        <?php
    }
    else {
    ?>
            <!--affichage de tous les produits-->
        <div class="parent">
            <?php
            foreach ($allProduits as $produit) {
                ?>
                <div class="child card">

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
        <?php
    }
    ?>


</div>

<?php
require_once 'footer.html.php';
