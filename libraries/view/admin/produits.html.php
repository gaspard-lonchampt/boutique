<?php
require_once '../../../template/layout.html.php';
require_once '../../../libraries/models/Produits.php';

$Produits = new Products();

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
    <?php $Produits->insertproduct(); ?>
    <form action="produits.html.php" method="post">
        <input type="number" name="product_type_id"> <br>
        <input type="text" name="product_name" placeholder="Nom du produit"><br>
        <input type="text" name="product_description" placeholder="Description"><br>
        <input type="text" name="other_product_details" placeholder="something to add ?"><br>
        <button name="submit">Valider !</button>
    </form>
</section>
