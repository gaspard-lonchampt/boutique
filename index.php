<?php
//require_once ('libraries/autoload.php');
//require_once 'libraries/models/Produits.php';


require_once'libraries/autoload.php';
// require_once'libraries/controllers/Controller.php';

$controller = new \Controllers\Products();
$controller2 = new \Models\Products();

$controller->delete();


if (isset($_POST["submit"])) {
    $id  = $_POST["id"];
    $nom = $_POST["product_name"];
    $description = $_POST["product_description"];
    $other = $_POST["other_product_details"];

    $pdo = new PDO('mysql:host=localhost;dbname=boutique;charset=utf8', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    $sql = "INSERT INTO `products` (`product_id`, `product_type_id`, `product_name`, `product_description`, `other_product_details`) VALUES (:product_id, (SELECT product_type_id from ref_product_types where product_type_id = 1), :product_name, :product_description, :other_product_details)";
    $query = $pdo->prepare($sql);
    var_dump($query);
    $query->execute(['product_id'=> $id,
        'product_name' => $nom,
        'product_description' => $description,
        'other_product_details' => $other]);
}

//$product = new Produit();

//$product->insert($value);

?>
<form action="" method="post">
    <input type="number" name="id" value="1"> <br>
    <input type="text" name="product_name" placeholder="Nom du produit"><br>
    <input type="text" name="product_description" placeholder="Description"><br>
    <input type="text" name="other_product_details" placeholder="something to add ?"><br>
    <button name="submit">Valider !</button>
</form>

<!--
<form action="" method="POST">
    <?php /**
    foreach ($columnNames as $columnName)
    {
        echo '<label for="' . $columnName . '">Enter your ' . $columnName . '</label>
            <input type="text" name="' . $columnName . '"><br>';
    }
    */?>
    <button>Insérer !</button>
</form>-->