<?php
require_once '../../autoload.php';
$repere = 1;
require_once 'layout_front.html.php';
require_once 'header.html.php';
$Produits = new \Models\Products();


$Produits->displayproducts();
$Produits->inventaire($_SESSION['product']['product_id']);

if (isset($_POST['submit'])) {
    $_POST['prix'] = $_SESSION['stock'][0]['price'];
}

?>

    <section id="main-content">
        <!-- VIDEO DE FOND DECRAN -->
        <video autoplay loop id="bgvid">
            <source src="../videos/3.mp4" type="video/webm">
            <source src="../videos/3.mp4" type="video/mp4">
        </video>

        <!-- Information produit-->

            <form class="mt-6 pt-6 is-flex is-align-content-center is-justify-content-center" method="POST" action="addpanier.php?product_id=<?= $_SESSION['product']['product_id'] ?>">

                <!-- titre à gauche -->
            <!-- <div class="is-flex is-align-content-center is-justify-content-center"> -->
                <!-- <div class="empty"></div> -->
                <div class="mt-6 pt-6 h2 is-flex is-align-content-center is-justify-content-flex-end column is-half">
                    <h2 class="mt-6 pt-6 is-flex is-align-content-center is-justify-content-flex-end"> <?= $_SESSION['product']['other_product_details']; ?></h2>
                </div>
                <!-- <div class="vide"></div> -->
            <!-- </div> -->

                <!-- card blanche -->
                <div class="card container column is-one-quarter mt-6 p-0">
                    <div class="titre">
                        <h1 class="has-text-centered p-1"> <?= $_SESSION['product']['product_name']; ?></h1>
                    </div>

                <div class="cat">
                    <h3><?= $_SESSION['product']['product_type_description']; ?></h3>
                </div>

                <div class="image01">
                    <img class="one01" src="../images/<?= $_SESSION['product']['product_image_1']?>" style="width:400px;" alt="<?= $_SESSION['product']['product_name']; ?>"/>
                    <img class="two" src="../images/<?= $_SESSION['product']['product_image_2']?>" style="width:400px;" alt="<?= $_SESSION['product']['product_name']; ?>"/>
                </div>

                <div class="prix01">
                    <h3 name="prix" ><?= $_SESSION['stock'][0]['price']; ?> €</h3>
                </div>

                <div class="quantite01">
                    <h3 class="mb-1">Quantité :</h3>
                    <div class="container">
                    <input class="input is-small" name="quantity" type="number" value="1" max="10" min="1">
                    </div>
                </div>

                <div class="taille01">
                    <h3 class="mb-1">Taille :</h3>
                    <div class="select is-small">
                    <select name="taille">
                        <?php
                        foreach ($_SESSION['stock'] as $key => $value) {
                            echo ('<option value="' . $value['attribute_size'] . '">' . $value['attribute_size'] . '</option>');
                        }
                        ?>
                    </select>
                    </div>
                </div>

                <div class="panier01 is-flex is-justify-content-center">
                    <button class="button is-warning mt-4" type="submit" href="addpanier.php?product_id=<?= $_SESSION['product']['product_id'] ?>">Ajouter au Panier</button>
                </div>
            </div>
        
        </form>


    </div>
</section>

<section id="descrptionproduit">
    <div class="grid-container2">
        <div class="description">
            <h2>Description du produit : </h2>
            <?= $_SESSION['product'][ 'product_description']; ?>
        </div>
        <div class="aside"></div>
    </div>
</section>
<section id="associ">
    <h2>Vous aimerez aussi : </h2>
    <div class="produitassocies">
        <div class="art1">
            <?php
            $allproduits = $Produits->associated();
            foreach ($allproduits as $products)
            {?>
                <div id="border">
                    <div class="image1">
                        <a href="produit.php?product_id=<?= $products['product_id'] ?>">
                            <img class="one01" src="../images/<?= $products['product_image_1']?>" style="width:200px;" alt="<?= $products['product_name']; ?>"/>
                            <img class="two" src="../images/<?= $products['product_image_2']?>" style="width:200px;" alt="<?= $products['product_name']; ?>"/>
                        </a>
                    </div>
                    <div class="prix-voir1">
                        <div class="bouton1">
                            <a href="produit.php?product_id=<?= $products['product_id'] ?>">Voir le produit</a>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</section>

<?php
require_once 'footer.html.php';
