<?php
require_once 'Model.php';

class Products extends Model
{
    protected $pdo;
    protected $table = "products";

    /**
     * Retourne un produit / user ...
     * @param int $id
     * @return mixed
     */
    public function findAll()
    {
        $sql = "SELECT `product_id`, ref_product_types.product_type_description, `product_name`, `product_description`, `other_product_details` FROM `products`NATURAL JOIN ref_product_types";

        $resultats = $this->pdo->query($sql);
        // On fouille le résultat pour en extraire les données réelles
        $articles = $resultats->fetchAll();

        return $articles;
    }

    public function findproducts(int $id)
    {
        $query = $this->pdo->prepare("SELECT * FROM 'products' WHERE id = :id");
        $query->bindValue(':product_id', $id, PDO::PARAM_INT);
        $query->execute();
        $item = $query->fetch();
        // On vérifie si le produit existe
        if (!$item) {
            $_SESSION['erreur'] = "Cet id n'existe pas";
            header('Location: products.html.php');
        }
    }

    public function insertproduct()
    {
        if (isset($_POST["formAddProduct"])) {

            if (isset($_POST['product_type_id']) && !empty($_POST['product_type_id'])
                && isset($_POST['product_name']) && !empty($_POST['product_name'])
                && isset($_POST['product_description']) && !empty($_POST['product_description'])
                && isset($_POST['other_product_details']) && !empty($_POST['other_product_details']))
            {
                $type = strip_tags($_POST["product_type_id"]);
                $nom = strip_tags($_POST["product_name"]);
                $description = strip_tags($_POST["product_description"]);
                $other = strip_tags($_POST["other_product_details"]);

                $sql = "INSERT INTO `products` (`product_type_id`, `product_name`, `product_description`, `other_product_details`) VALUES ((SELECT product_type_id from ref_product_types where product_type_id = :product_type_id), :product_name, :product_description, :other_product_details)";
                $query = $this->pdo->prepare($sql);
                //var_dump($query);
                $query->bindValue(':product_type_id', $type, PDO::PARAM_INT);
                $query->bindValue(':product_name', $nom, PDO::PARAM_STR);
                $query->bindValue(':product_description', $description, PDO::PARAM_STR);
                $query->bindValue(':other_product_details', $other, PDO::PARAM_STR);
                $query->execute();

                $_SESSION['message'] = "Le produit a été ajouté";

                $attribute = 1;
                $sql = "INSERT INTO `products_image`(`attribute_value_id`, `product_image_1`, `product_image_2`) VALUES (:attribute_value_id, :product_image_1, :product_image_2);";
                $requete = $this->pdo->prepare($sql);
                $requete->bindValue(':attribute_value_id', $attribute, PDO::PARAM_INT);
                $requete->bindValue(':product_image_1', 'no-pic.JPG', PDO::PARAM_STR);
                $requete->bindValue(':product_image_2', 'no-pic.JPG', PDO::PARAM_STR);
                $requete->execute();
                $_SESSION['message'] = "L'image' a été ajouté";
                header('Location:products.html.php');

            }
            else {
                $_SESSION['erreur'] = "le formulaire n'est pas complet";
            }
        }
    }

    /**
     * GESTION DES PRODUITS -> Supprime un produit
     *
     * @param $product_id
     */
    public function deleteProduct(int $product_id)
    {
        if (isset($_GET['hiddenDeleteProduct']) && !empty($_GET['hiddenDeleteProduct'])) {

            // On nettoie l'id envoyé
            $product_id = strip_tags($_GET['hiddenDeleteProduct']);

            $sql = 'SELECT * FROM `products` WHERE product_id = :product_id;';

            //On prépare requête
            $query = $this->pdo->prepare($sql);

            //On accroches les paramètres
            $query->bindValue(':product_id', $product_id, PDO::PARAM_INT);

            // On exécute la requête
            $query->execute();

            // On récupère le produit
            $produit = $query->fetch();

            // On vérifie si le produit existe
            if (!$produit){
                $_SESSION['erreur'] = "Cet id n'existe pas";
            }

            $sql2 = 'DELETE FROM `products` WHERE product_id = :product_id;';

            //On prépare requête
            $query2 = $this->pdo->prepare($sql2);

            //On accroches les paramètres
            $query2->bindValue(':product_id', $product_id, PDO::PARAM_INT);

            // On exécute la requête

            $query2->execute();

            $_SESSION['message'] = "produit supprimé";

        } else {
            echo 'pas idi';
            $_SESSION['erreur'] = "il y a un autre problème";
        }
    }

    /**
     * Affiche l'inventaire à d'un produit défini par product_id
     */
    public function inventaire($id){
        $sql = "SELECT * FROM `attribute_value` 
                    NATURAL JOIN stock
                WHERE product_id = :product_id";
        //SELECT `stock_id`,ref_product_types.product_type_description, `quantity`, `price` FROM `stock` NATURAL JOIN attribute_value NATURAL JOIN ref_product_types
        $query = $this->pdo->prepare($sql);
        $query->bindValue(':product_id', $id, PDO::PARAM_INT);
        $query->execute();
        $stock = $query->fetchAll();
        return $stock;
    }

    /**
     * Insert le stock d'un produit définit par son product_id
     */
    public function insertstock() {
        if (isset($_POST["addStock"]))
        {
            if (isset($_POST['attribut']) && !empty($_POST['attribut'])
                && isset($_POST['quantity']) && !empty($_POST['quantity'])
                && isset($_POST['price']) && !empty($_POST['price'])
                && isset($_POST['product_id']))
            {

                $attribut = $_POST['attribut'];
                $quantity = $_POST['quantity'];
                $price = $_POST['price'];
                $id = $_SESSION['product_id'];

                $sql = "INSERT INTO `stock`(`product_id`, `attribute_value_id`, `quantity`, `price`) VALUES (:id, :attribute_value_id, :quantity, :price)";
                $query = $this->pdo->prepare($sql);
                //var_dump($query);
                $query->bindValue(':id', $id, PDO::PARAM_INT);
                $query->bindValue(':attribute_value_id', $attribut, PDO::PARAM_INT);
                $query->bindValue(':quantity', $quantity, PDO::PARAM_INT);
                $query->bindValue(':price', $price, PDO::PARAM_INT);
                $query->execute();

                $_SESSION['message'] = "Le stock a été ajouté";
            }
            else {
                $_SESSION['erreur'] = "le formulaire n'est pas complet";
            }
        }
    }

    public function updateStock() {

    }
}