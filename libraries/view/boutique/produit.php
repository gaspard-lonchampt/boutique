<?php
session_start();
$repere = 1;
require_once '../../autoload.php';
$Produits = new \Models\Products();

$_GET['product_id'] = 1;
$_SESSION['product']['product_id'] = 1;

$Produits->displayproducts();
$Produits->inventaire($_SESSION['product']['product_id']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Espace Admin - <?= $pageTitle ?></title>

    <link rel="stylesheet" href="produit.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Average&family=Fjalla+One&display=swap" rel="stylesheet">
</head>
<body>
    <section id="main-content">
        <!-- VIDEO DE FOND DECRAN -->
        <video autoplay loop id="bgvid">
            <source src="../videos/1.mp4" type="video/webm">
            <source src="../videos/1.mp4" type="video/mp4">
        </video>

        <!-- Information produit-->
        <div class="grid-container">


            <form method="post">
                <!-- card blanche -->
                <div class="card">
                    <div class="titre">
                        <h1><?= $_SESSION['product']['product_name']; ?></h1>
                    </div>

                    <div class="cat">
                        <?= $_SESSION['product']['product_type_description']; ?>
                    </div>

                    <div class="image">
                        <img src="../images/<?= $_SESSION['product']['product_image_1']?>" style="width:400px;" alt="<?= $_SESSION['product']['product_name']; ?>"/>
                    </div>

                    <div class="prix">
                        <h3><?= $_SESSION['stock'][1]['price']; ?> €</h3>
                    </div>

                    <div class="quantity">
                        Quantité :<br>
                        <input type="number" value="1" max="3">
                    </div>

                    <div class="taille">
                        Taille :<br>
                        <select name="taille">
                            <?php
                            foreach ($_SESSION['stock'] as $key => $value) {
                                echo ('<option value="' . $value['attribute_size'] . '">' . $value['attribute_size'] . '</option>');
                            }
                            ?>
                        </select>
                    </div>

                    <div class="panier">
                        <input type="submit" name="addtobasket" value="Ajouter au panier">
                    </div>
                </div>
            </form>


            <!-- titre à gauche -->
            <div class="left">
                <div class="empty"></div>
                <div class="h2"><h2><?= $_SESSION['product']['other_product_details']; ?></h2></div>
                <div class="vide"></div>
            </div>
        </div>
    </section>

    <section id="descrptionproduit">
        <div class="grid-container2">
            <div class="description">
                <?= $_SESSION['product'][ 'product_description']; ?>
            </div>
            <div class="aside"></div>
        </div>
    </section>

</body>

</html>