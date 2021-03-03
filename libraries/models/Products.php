<?php
require_once 'Model.php';

class Products extends Model
{
    protected $pdo;
    protected $table = "products";

    /**
     * Retourne un produit
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

    public function displayProductInventaire(){
        $sql = "SELECT * FROM ref_product_types NATURAL JOIN stock NATURAL JOIN products;";
        $resultats = $this->pdo->query($sql);
        // On fouille le résultat pour en extraire les données réelles
        $stock = $resultats->fetchAll();
        return $stock;
    }


    /**
     * ON va faire afficher les détails d'un produit, incluant l'image
     *
     */
    public function displayproducts()
    {
        // Est-ce qu'il existe et n'est pas vide dans l'url?
        if (isset($_GET['product_id']) && !empty($_GET['product_id']))
        {
            // On nettoie l'id envoyé
            $product_id = strip_tags($_GET['product_id']);

            $sql = 'SELECT `product_id`, product_type_description, `product_name`, `product_description`, `other_product_details`, product_image_1, product_image_2 FROM `products` NATURAL JOIN ref_product_types NATURAL JOIN products_image WHERE product_id = :product_id';

            //On prépare requête
            $query = $this->pdo->prepare($sql);

            //On accroches les paramètres
            $query->bindValue(':product_id', $product_id, PDO::PARAM_INT);

            // On exécute la requête
            $query->execute();

            // On récupère le produit
            $produit = $query->fetch();

            //var_dump($produit);
            //on definit une session
            $_SESSION['product_id'] = $produit['product_id'];
            $_SESSION['product_type_description'] = $produit['product_type_description'];
            $_SESSION['product_name'] = $produit ['product_name'];
            $_SESSION['product_description'] = $produit['product_description'];
            $_SESSION['other_product_details'] = $produit['other_product_details'];
            $_SESSION['product_image_1'] = $produit['product_image_1'];
            $_SESSION['product_image_2'] = $produit['product_image_2'];

            /**  ca marchait, mais ça marche plus ¯\_(ツ)_/¯
             * ça n'affiche pas la fiche produit meme si elle existe
            // On vérifie si le produit existe
            if (!$produit){
            $_SESSION['erreur'] = "Cet id n'existe pas";
            header('Location: products.html.php');
            }
             */
        } else {
            $_SESSION['erreur'] = "URL invalide";
            header('Location: products.html.php');
        }
    }

    /**
     * Inserer un produit dans la bdd, une image de base s'ajoutera automatiquement
     */
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
                //header('Location:products.html.php');
            }
            else {
                $_SESSION['erreur'] = "le formulaire n'est pas complet";
            }
        }
    }

    /**
     * GESTION DES PRODUITS -> Modifier un produit
     *
     */
    public function updateproduct(){
        if (isset($_POST['modifierlesodonnees'])) {
            if (isset($_POST['product_id']) && !empty($_POST['product_id'])
                && isset($_POST['product_type_id']) && !empty($_POST['product_type_id'])
                && isset($_POST['product_name']) && !empty($_POST['product_name'])
                && isset($_POST['product_description']) && !empty($_POST['product_description'])
                && isset($_POST['other_product_details']) && !empty($_POST['other_product_details'])) {

                $id = strip_tags($_POST["product_id"]);
                $type = strip_tags($_POST["product_type_id"]);
                $nom = strip_tags($_POST["product_name"]);
                $description = strip_tags($_POST["product_description"]);
                $other = strip_tags($_POST["other_product_details"]);

                $sql = "UPDATE `products` SET `product_type_id`=:product_type_id, `product_name`=:product_name, `product_description`=:product_description, `other_product_details`=:other_product_details WHERE product_id=:product_id";
                $query = $this->pdo->prepare($sql);
                //var_dump($query);
                $query->bindValue(':product_id', $id, PDO::PARAM_INT);
                $query->bindValue(':product_type_id', $type, PDO::PARAM_INT);
                $query->bindValue(':product_name', $nom, PDO::PARAM_STR);
                $query->bindValue(':product_description', $description, PDO::PARAM_STR);
                $query->bindValue(':other_product_details', $other, PDO::PARAM_STR);
                $query->execute();

                $_SESSION['message'] = "Le produit a été modifié";

            } else {
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

            $sql2 = 'DELETE FROM `stock` WHERE `product_id`=:product_id; DELETE FROM `products` WHERE product_id = :product_id;';

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
     * UPDATE IMAGE ICI (1 et 2 en deux if séparé)
     */
    public function updateimage(){
        if (isset($_POST['updateimg1']))
        {
            //Vérification que ce ne soit pas vide
            if (isset($_FILES['photo']) && !empty($_FILES['photo']['name']))
            {
                //On définit la taille de l'image
                $tailleMax = 2097152;
                //On définit les formats valides
                $extensionsValide = ['jpg', 'jpeg', 'gif', 'png'];

                if ($_FILES['photo']['size'] <= $tailleMax)
                {
                    //on renvoie l'enxtension du fichier avec '.' devant = strrchr
                    //on va venir ignorer le 1er charactère la chaine = substr : 1
                    //on met tout en minuscule = strtolower
                    $extensionsUpload = strtolower(substr(strrchr($_FILES['photo']['name'],'.'),1));
                    if (in_array($extensionsUpload, $extensionsValide))
                    {
                        //on détermine où les photos seront upload
                        $chemin = "../images/" . $_POST['product_id'] . "." . $extensionsUpload;
                        //on va les placer dans le bon dossier
                        $deplacement = move_uploaded_file($_FILES['photo']['tmp_name'], $chemin);

                        if ($deplacement)
                        {
                            $pdo = new PDO('mysql:host=localhost;dbname=boutique;charset=utf8', 'root', '', [
                                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                            ]);
                            $sql = "UPDATE `products_image` SET `product_image_1` = :product_image_1 WHERE product_id = :product_id";
                            $updateAvatar = $pdo->prepare($sql);
                            $updateAvatar->bindValue(':product_id', $_POST['product_id'], PDO::PARAM_INT);
                            $updateAvatar->bindValue(':product_image_1', $_POST['product_id'] . "." . $extensionsUpload);
                            $updateAvatar->execute();
                        }
                        else {
                            $_SESSION['erreur'] = "Erreur durant l'importation de la photo";
                        }
                    }
                    else {
                        $_SESSION['erreur'] = "La photo doit être au format : jpg, jpeg, gif, png.";
                    }
                }
                else {
                    $_SESSION['erreur'] = "L'image est trop lourde, 2Mo maximum";
                }
            }
        }
        if (isset($_POST['updateimg2']))
        {
            //Vérification que ce ne soit pas vide
            if (isset($_FILES['photo']) && !empty($_FILES['photo']['name']))
            {
                //On définit la taille de l'image
                $tailleMax = 2097152;
                //On définit les formats valides
                $extensionsValide = ['jpg', 'jpeg', 'gif', 'png'];

                if ($_FILES['photo']['size'] <= $tailleMax)
                {
                    //on renvoie l'enxtension du fichier avec '.' devant = strrchr
                    //on va venir ignorer le 1er charactère la chaine = substr : 1
                    //on met tout en minuscule = strtolower
                    $extensionsUpload = strtolower(substr(strrchr($_FILES['photo']['name'],'.'),1));
                    if (in_array($extensionsUpload, $extensionsValide))
                    {
                        //on détermine où les photos seront upload
                        $chemin = "../images/" . $_POST['product_id'] . "-2." . $extensionsUpload;
                        //on va les placer dans le bon dossier
                        $deplacement = move_uploaded_file($_FILES['photo']['tmp_name'], $chemin);

                        if ($deplacement)
                        {
                            $pdo = new PDO('mysql:host=localhost;dbname=boutique;charset=utf8', 'root', '', [
                                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                            ]);
                            $sql = "UPDATE `products_image` SET `product_image_2` = :product_image_2 WHERE product_id = :product_id";
                            $updateAvatar = $pdo->prepare($sql);
                            $updateAvatar->bindValue(':product_id', $_POST['product_id'], PDO::PARAM_INT);
                            $updateAvatar->bindValue(':product_image_2', $_POST['product_id'] . "-2." . $extensionsUpload);
                            $updateAvatar->execute();
                        }
                        else {
                            $_SESSION['erreur'] = "Erreur durant l'importation de la photo";
                        }
                    }
                    else {
                        $_SESSION['erreur'] = "La photo doit être au format : jpg, jpeg, gif, png.";
                    }
                }
                else {
                    $_SESSION['erreur'] = "L'image est trop lourde, 2Mo maximum";
                }
            }
        }
    }

    /**
     * Affiche l'inventaire à d'un produit défini par product_id
     */
    public function inventaire($id){
        $sql = "SELECT * FROM `attribute_value` 
                    NATURAL JOIN stock
                WHERE product_id = :product_id";
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

    /**
     * Modifier le stock sur la quantité et le prix
     */
    public function updateStock()
    {
        if (isset($_POST['modifierlestock']))
        {
            if (isset($_POST['quantite']) && isset($_POST['prix']) && isset($_POST['stock_id']))
            {
                $quantity = $_POST['quantite'];
                $price = $_POST['prix'];
                $stock_id = $_POST['stock_id'];

                $sql = "UPDATE `stock` SET `quantity`= :quantity, `price`= :price WHERE `stock_id` = :stock_id";
                $query = $this->pdo->prepare($sql);
                $query->bindValue(':quantity', $quantity, PDO::PARAM_INT);
                $query->bindValue(':price', $price, PDO::PARAM_INT);
                $query->bindValue(':stock_id', $stock_id, PDO::PARAM_INT);
                $query->execute();

                $_SESSION['message'] = "l'inventaire à été modifier";
            } else {
                $_SESSION['erreur'] = "le formulaire n'est pas complet";
            }
        }
    }

    /**
     * GESTION DE L'INVENTAIRE -> Supprime un stock
     *
     */
    public function deleteStock($stock_id)
    {
        if (isset($_GET['hiddenDeleteInventaire']) && !empty($_GET['hiddenDeleteInventaire'])) {

            // On nettoie l'id envoyé
            $stock_id = strip_tags($_GET['hiddenDeleteInventaire']);

            $sql = 'SELECT * FROM `stock` WHERE stock_id = :stock_id;';

            //On prépare requête
            $query = $this->pdo->prepare($sql);

            //On accroches les paramètres
            $query->bindValue(':stock_id', $stock_id, PDO::PARAM_INT);

            // On exécute la requête
            $query->execute();

            // On récupère le produit
            $stock = $query->fetch();

            var_dump($stock);

            // On vérifie si le produit existe
            if (!$stock){
                $_SESSION['erreur'] = "Cet id n'existe pas";
            }

            $sql2 = 'DELETE FROM `stock` WHERE `stock_id`=?;';

            //On prépare requête
            $query2 = $this->pdo->prepare($sql2);

            //On accroches les paramètres
            //$query2->bindValue(':stock', $stock_id, PDO::PARAM_INT);

            echo 'yo';
            var_dump($query2);
            // On exécute la requête
            $query2->execute([$stock_id]);
            echo 'ya';
            $_SESSION['message'] = "stock supprimé";

        } else {
            echo 'pas id';
            $_SESSION['erreur'] = "il y a un autre problème";
        }
    }
}