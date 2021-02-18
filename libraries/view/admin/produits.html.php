<?php
require_once '../../../template/layout.html.php';
require_once '../../../libraries/models/Produits.php';

$Produits = new Produits();

?>
<section>
    <!-- GESTION DES PRODUITS -->
    <section>
        <table>
            <thead>
                <th>ID</th>
                <th>Type Produit id</th>
                <th>Titre</th>
                <th>Description</th>
                <th>Autres Details</th>
            </thead>
            <tbody>
            <?php

            $articles = $Produits -> findAll();

            foreach ($articles as $allArticles)
            {
                echo ('<form action="" method="get">
                           <tr>
                               <td>' . $allArticles['product_id'] . '</td>
                               <td>' . $allArticles['product_type_id'] . '</td>
                               <td>' . $allArticles['product_name'] . '</td>
                               <td>' . $allArticles['product_description'] . '</td>
                               <td>' . $allArticles['other_product_details'] . '</td>
                               <td style="border: none;">
                               <input type="submit" id="modify_Article" name="modifyArticle" value="Modifier">
                               <input type="hidden" id="hiddenModifyArticle" name="hiddenModifyArticle" value="' . $allArticles['product_id'] . '">
                               <input type="submit" id="delete_Article" name="deleteArticle" onclick="return confirm(\'Etes vous sûre de vouloir supprimer cet article ?\');" value="Supprimer">
                               <input type="hidden" id="hiddenDeleteArticle" name="hiddenDeleteArticle" value="' . $allArticles['product_id'] . '">
                               </td>
                           </tr>
                        </form>');
            }
            ?>
            </tbody>
        </table>
        <?php
        if (isset($_GET['modifyArticle']))
        {
        $Produits -> update($_GET['hiddenDeleteArticle']);
        }

        if (isset($_GET['deleteArticle']))
        {
            $Produits -> delete($_GET['hiddenDeleteArticle']);
        }
        ?>
    </section>


    <!--AJOUT DUN NOUVEAU PRODUIT-->
    <?php

    $var = $Produits->insert("products", "`product_type_id`, `product_name`, `product_description`, `other_product_details`", "(SELECT product_type_id from ref_product_types where product_type_id = :product_type_id), :product_name, :product_description, :other_product_details");

    var_dump($var);

    if (isset($_POST["submit"])) {
        $type = $_POST["product_type_id"];
        $nom = $_POST["product_name"];
        $description = $_POST["product_description"];
        $other = $_POST["other_product_details"];

        $pdo = new PDO('mysql:host=localhost;dbname=boutique;charset=utf8', 'root', '', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);

        $sql = "INSERT INTO `products` (`product_type_id`, `product_name`, `product_description`, `other_product_details`) VALUES ((SELECT product_type_id from ref_product_types where product_type_id = :product_type_id), :product_name, :product_description, :other_product_details)";
        $query = $pdo->prepare($sql);
        //var_dump($query);
        $query->execute(['product_type_id' => $type,
            'product_name' => $nom,
            'product_description' => $description,
            'other_product_details' => $other
        ]);
    }
    ?>
    <form action="" method="post">
        <input type="number" name="product_type_id"> <br>
        <input type="text" name="product_name" placeholder="Nom du produit"><br>
        <input type="text" name="product_description" placeholder="Description"><br>
        <input type="text" name="other_product_details" placeholder="something to add ?"><br>
        <button name="submit">Valider !</button>
    </form>
</section>
