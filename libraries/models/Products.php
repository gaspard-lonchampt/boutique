<?php
require_once 'Model.php';

class Products extends Model
{
    protected $pdo;
    protected $table = "products";

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

    public function update() {
        
    }
}