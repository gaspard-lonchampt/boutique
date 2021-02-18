<?php
require_once 'Model.php';

class Produits extends Model
{
    protected $pdo;
    protected $table = "products";

    /**
     * GESTION ARTILCES -> Permet d'afficher les valeurs d'articles selectionnés dans les champs du formulaire de modification
     *
     * @param $id
     * @return array
     */
    public function replaceValueArticle($id): array
    {
        $query = $this -> pdo -> prepare("SELECT `product_id`, `product_type_id`, `product_name`, `product_description`, `other_product_details` FROM products WHERE id = :id");
        $query -> execute([
            "id" => $id
        ]);

        $result = $query -> fetch(PDO::FETCH_ASSOC);

        $_SESSION['product_id'] = $result['product_id'];
        $_SESSION['product_type_id'] = $result['product_type_id'];
        $_SESSION['product_name'] = $result['product_name'];
        $_SESSION['product_description'] = $result['product_description'];
        $_SESSION['other_product_details'] = $result['other_product_details'];

        return $_SESSION;
    }

    /**
     * GESTION ARTILCES -> Permet d'afficher le formulaire de modification d'articles
     *
     * @param $id
     */
    public function displayUpdateArticle($id)
    {
        $this -> replaceValueArticle($id);
        echo ('<form action="" method="post" style="margin-top: 5%">
                   <section class="container"><input type="number" id="update_product_type_id" name="update_product_type_id" value="' . $_SESSION['product_type_id'] . '"></section>
                   <section class="container"><input type="text" id="update_product_name" name="update_product_name" value="' . $_SESSION['product_name'] . '"></section>
                   <section class="container"><input type="text" id="update_product_description" name="update_product_description" value="' . $_SESSION['product_description'] . '"></section>
                   <section class="container"><textarea type="text" id="update_other_product_details" name="update_other_product_details">' . $_SESSION['other_product_details'] . '...</textarea></section>
                   <section class="container"><input type="submit" class="btn btn-warning" id="valid_update" name="validUpdate" value="Valider"></section>
               </form>');

        if (isset($_POST['validUpdate']))
        {
            $update_product_type_id = htmlspecialchars(trim($_POST['update_product_type_id']));
            $update_product_name = htmlspecialchars(trim($_POST['update_product_name']));
            $update_product_description = htmlspecialchars(trim($_POST['update_product_description']));
            $update_other_product_details = htmlspecialchars(trim($_POST['update_other_product_details']));

            $query = $this -> pdo -> prepare("UPDATE articles SET :product_type_id, :product_name, :product_description, :other_product_details WHERE product_id = :product_id");
            $query -> execute([
                "tproduct_type_id" => $update_product_type_id,
                "product_name" => $update_product_name,
                "product_description" => $update_product_description,
                "other_product_details" => $update_other_product_details
            ]);
        }
    }

    /**
     * GESTION DES ARTICLES -> Supprime un article
     *
     * @param $id
     */
    public function deleteArticle($id)
    {
        $query = $this -> pdo -> prepare("DELETE FROM articles WHERE id = :id");
        $query -> execute([
            "id" => $id
        ]);

        Http::redirect("../pages/admin.php");
    }
}