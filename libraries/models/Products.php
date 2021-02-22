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
    public function findproducts(int $id)
    {
        $query = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $query->bindValue('id', $id, PDO::PARAM_INT);
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
        if (isset($_POST["submit"])) {
            $type = $_POST["product_type_id"];
            $nom = $_POST["product_name"];
            $description = $_POST["product_description"];
            $other = $_POST["other_product_details"];

            $sql = "INSERT INTO `products` (`product_type_id`, `product_name`, `product_description`, `other_product_details`) VALUES ((SELECT product_type_id from ref_product_types where product_type_id = :product_type_id), :product_name, :product_description, :other_product_details)";
            $query = $this->pdo->prepare($sql);
            //var_dump($query);
            $query->execute(['product_type_id' => $type,
                'product_name' => $nom,
                'product_description' => $description,
                'other_product_details' => $other
            ]);
        }
    }

    /**
     * GESTION PRODUITS-> Permet d'afficher les valeurs des produits selectionnés dans les champs du formulaire de modification
     *
     * @param $id
     * @return array
     */
    public function replaceValueProduct($id): array
    {
        $query = $this->pdo->prepare("SELECT product_type_id, product_name, product_description, other_product_details FROM products WHERE id = :id");
        $query->execute([
            "id" => $id
        ]);

        $result = $query->fetch(PDO::FETCH_ASSOC);

        $_SESSION['product_type_id'] = $result['product_type_id'];
        $_SESSION['product_name'] = $result['product_name'];
        $_SESSION['product_description'] = $result['product_description'];
        $_SESSION['other_product_details'] = $result['other_product_details'];

        return $_SESSION;
    }

    /**
     * GESTION PRODUITS -> Permet d'afficher le formulaire de modification de produits
     *
     * @param $id
     */
    public function displayUpdateProduit($id)
    {
        $this->replaceValueProduct($id);
        echo('<form action="" method="post" style="margin-top: 5%">
                   <section class="container"><input type="number" id="product_type_id" name="product_type_id" value="' . $_SESSION['product_type_id'] . '"></section>
                   <section class="container"><input type="text" id="product_name" name="product_name" value="' . $_SESSION['product_name'] . '"></section>
                   <section class="container"><textarea type="text" id="product_description" name="product_description">' . $_SESSION['product_description'] . '...</textarea></section>
                   <section class="container"><textarea type="text" id="other_product_details" name="other_product_details">' . $_SESSION['other_product_details'] . '...</textarea></section>
                   <section class="container"><input type="submit" class="btn btn-warning" id="valid_update" name="validUpdate" value="Valider"></section>
               </form>');

        if (isset($_POST['validUpdate'])) {
            $update_type_id = htmlspecialchars(trim($_POST['product_type_id']));
            $update_name = htmlspecialchars(trim($_POST['product_name']));
            $update_description = htmlspecialchars(trim($_POST['product_description']));
            $update_other_details = htmlspecialchars(trim($_POST['other_product_details']));

            $query = $this->pdo->prepare("UPDATE products SET product_type_id = :product_type_id, product_name = :product_name, product_description = :product_description, other_product_details = :other_product_details WHERE id = :id");
            $query->execute([
                "product_type_id" => $update_type_id,
                "product_name" => $update_name,
                "product_description" => $update_description,
                "other_product_details" => $update_other_details,
                "id" => $id
            ]);
        }
    }

    /**
     * GESTION DES PRODUITS -> Supprime un produit
     *
     * @param $id
     */
    public function deleteProduct($id)
    {
        $query = $this -> pdo -> prepare("DELETE FROM products WHERE id = :id");
        $query -> execute([
            "id" => $id
        ]);

        Http::redirect("../pages/admin.php");
    }
}