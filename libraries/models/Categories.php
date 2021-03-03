<?php
require_once 'Model.php';


/**
 * Class Categories and Attribute value
 * ici pour les catégories de produit (Apparel => pull, tee-shirt, jeans,... ; Music => dématérialisée, vinyles,...)
 * et pour leurs attributs (taille, couleur, ...)
 */
class Categories extends Model
{
    protected $pdo;
    protected $table;

    /**
     *  affiche les catégories
     */
    public function findAllCategories()
    {
        $sql = "SELECT * FROM `ref_product_types`";
        $resultats= $this->pdo->query($sql);
        $categories = $resultats->fetchAll();
        return $categories;
    }

    /**
     * créer une catégorie
     */
    public function insertCat()
    {
        if (isset($_POST["addCat"]))
        {
            if (isset($_POST['parent_product_type_code']) && !empty($_POST['parent_product_type_code'])
                && isset($_POST['product_type_description']) && !empty($_POST['product_type_description']))
            {
                $parent = $_POST['parent_product_type_code'];
                $desc = strip_tags($_POST['product_type_description']);

                $sql = "INSERT INTO `ref_product_types` (`parent_product_type_code`, `product_type_description`) VALUES (:parent_product_type_code, :product_type_description)";
                $query = $this->pdo->prepare($sql);
                //var_dump($query);
                $query->bindValue(':parent_product_type_code', $parent, PDO::PARAM_INT);
                $query->bindValue(':product_type_description', $desc, PDO::PARAM_STR);
                $query->execute();

                $_SESSION['message'] = "La categorie a été ajouté";
                //header('Location:categories-attribute.html.php');
            }
            else {
                $_SESSION['erreur'] = "le formulaire n'est pas complet";
                header('Location:categories-attribute.html.php');
            }
        }
    }

    /**
     * supprime une catégorie
     */
    public function deleteCat(int $product_type_id)
    {
        if (isset($_GET['hiddenDeleteCat']) && !empty($_GET['hiddenDeleteCat'])) {

            // On nettoie l'id envoyé
            $product_type_id = strip_tags($_GET['hiddenDeleteCat']);

            $sql = 'SELECT * FROM `ref_product_types` WHERE product_type_id = :product_type_id;';

            //On prépare requête
            $query = $this->pdo->prepare($sql);

            //On accroches les paramètres
            $query->bindValue(':product_type_id', $product_type_id, PDO::PARAM_INT);

            // On exécute la requête

            $query->execute();

            // On récupère le produit
            $produit = $query->fetch();

            // On vérifie si le produit existe
            if (!$produit) {
                $_SESSION['erreur'] = "Cet id n'existe pas";
            }

            $sql2 = 'DELETE FROM `ref_product_types` WHERE product_type_id = :product_type_id;';

            //On prépare requête
            $query2 = $this->pdo->prepare($sql2);

            //On accroches les paramètres
            $query2->bindValue(':product_type_id', $product_type_id, PDO::PARAM_INT);

            // On exécute la requête
            $query2->execute();

            $_SESSION['message'] = "produit supprimé";
            header('Location:categories-attribute.html.php');

        } else {
            echo 'pas idi';
            $_SESSION['erreur'] = "il y a un autre problème";
            header('Location:categories-attribute.html.php');
        }
    }

    /**
     * affiche les attributs
     */

    public function findAllAttribut()
    {
        $sql = "SELECT `attribute_value_id`, `product_type_id`, ref_product_types.product_type_description, `attribute_color`, `attribute_size` FROM `attribute_value` NATURAL JOIN `ref_product_types` ORDER BY `attribute_color`, `attribute_size`, `product_type_description`";
        $resultats= $this->pdo->query($sql);
        $attributs = $resultats->fetchAll();
        return $attributs;
    }

    /**
     * créer un attribut
     */
    public function insertAtt()
    {
        if (isset($_POST["addAtt"]))
        {
            if (isset($_POST['product_type_id']) && !empty($_POST['product_type_id'])
                && isset($_POST['attribute_color']) && !empty($_POST['attribute_color'])
                && isset($_POST['attribute_size']) && !empty($_POST['attribute_size']))
            {
                // on va vérifier si la combinaison existe dejà

                $type = $_POST['product_type_id'];
                $color = $_POST['attribute_color'];
                $size = $_POST['attribute_size'];

                $sqlselect="SELECT `product_type_id`, `attribute_color`, `attribute_size` FROM `attribute_value` WHERE product_type_id = :product_type_id AND attribute_color = :attribute_color AND attribute_size = :attribute_size";
                $queryselect = $this->pdo->prepare($sqlselect);
                $queryselect->bindValue(':product_type_id', $type, PDO::PARAM_INT);
                $queryselect->bindValue(':attribute_color', $color, PDO::PARAM_STR);
                $queryselect->bindValue(':attribute_size', $size, PDO::PARAM_STR);
                $queryselect->execute();

                $resultatselect = $queryselect->fetch();
                 if ($resultatselect) {
                     $_SESSION['erreur'] = "la combinaison existe déjà. Veuillez la selectionner directement dans le stock du produit en question";
                 }
                 else {
                     //On entre les valeurs car la combinaison choisie n'existe pas.
                     $sql = "INSERT INTO `attribute_value` (`product_type_id`, `attribute_color`, `attribute_size`) VALUES (:product_type_id, :attribute_color, :attribute_size)";
                     $query = $this->pdo->prepare($sql);
                     //var_dump($query);
                     $query->bindValue(':product_type_id', $type, PDO::PARAM_INT);
                     $query->bindValue(':attribute_color', $color, PDO::PARAM_STR);
                     $query->bindValue(':attribute_size', $size, PDO::PARAM_STR);
                     $query->execute();

                     $_SESSION['message'] = "L'attribut a été ajouté";
                 }
            }
            else {
                $_SESSION['erreur'] = "le formulaire n'est pas complet";
            }
        }
    }

    /**
     * supprime un attribut
     */

    public function deleteAtt($attribute_value_id)
    {
        if (isset($_GET['hiddenDeleteAttribut']) && !empty($_GET['hiddenDeleteAttribut'])) {

            // On nettoie l'id envoyé
            $attribute_value_id = strip_tags($_GET['hiddenDeleteAttribut']);

            $sql = 'SELECT * FROM `attribute_value` WHERE attribute_value_id = :attribute_value_id;';

            //On prépare requête
            $query = $this->pdo->prepare($sql);

            //On accroches les paramètres
            $query->bindValue(':attribute_value_id', $attribute_value_id, PDO::PARAM_INT);

            // On exécute la requête
            $query->execute();

            // On récupère le produit
            $attribut= $query->fetch();

            // On vérifie si le produit existe
            if (!$attribut){
                $_SESSION['erreur'] = "Cet id n'existe pas";
            }

            $sql2 = 'DELETE FROM `attribute_value` WHERE attribute_value_id = :attribute_value_id;';

            //On prépare requête
            $query2 = $this->pdo->prepare($sql2);

            //On accroches les paramètres
            $query2->bindValue(':attribute_value_id', $attribute_value_id, PDO::PARAM_INT);

            // On exécute la requête
            $query2->execute();

            $_SESSION['message'] = "produit supprimé";
            header('Location:categories-attribute.html.php');

        } else {
            echo 'pas idi';
            $_SESSION['erreur'] = "il y a un autre problème";
            header('Location:categories-attribute.html.php');
        }
    }
}