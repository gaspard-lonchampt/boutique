<?php

namespace Models;

class Panier extends Models
{

    protected $pdo;

    public function __construct()
    {
        parent::__construct();

        if (!isset($_SESSION)) {
            session_start();
        }
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = array();
        }
    }

    public function add($Produits_id, $taille, $quantity, $prix)
    {
        echo "ici var_dump dans fonction add";
        echo "<pre>";
        var_dump($Produits_id);
        echo "</pre>";
        echo "<pre>";
        var_dump($_SESSION['panier']);
        echo "</pre>";
        
        if ($_SESSION['panier'] == null) {
            echo "ici premier if";
            $_SESSION['panier'][$Produits_id] = [];
            $_SESSION['panier'][$Produits_id]['taille'] = $taille;
            $_SESSION['panier'][$Produits_id]['quantity'] = $quantity;
            $_SESSION['panier'][$Produits_id]['prix'] = $prix;

        } else {
            foreach (array_keys($_SESSION['panier']) as $id) {
                echo "ici foreach";
                if ($id == $Produits_id) {
                    echo "ici if dans foreach";
                    echo "<pre>";
                    var_dump($_SESSION['panier']);
                    echo "</pre>";
                    echo "<pre>";
                    echo "ici quantity";
                    var_dump($quantity);
                    echo "</pre>";
                    echo "ici id";
                    echo "<pre>";
                    var_dump($id);
                    echo "</pre>";
                    // $_SESSION['panier'][$Produits_id]['quantity'] = [];
                    $quantity = $_SESSION['panier'][$Produits_id]['quantity'] + $quantity;
                    $_SESSION['panier'][$Produits_id]['quantity'] = $quantity;
                    echo "ici quantité additionné";
                    var_dump($quantity);
                    break;
                }
            }if ($_SESSION['panier'] != $Produits_id) {
                $_SESSION['panier'][$Produits_id] = [];
                $_SESSION['panier'][$Produits_id]['taille'] = $taille;
                $_SESSION['panier'][$Produits_id]['quantity'] = $quantity;
                $_SESSION['panier'][$Produits_id]['prix'] = $prix;

            }

        }

        // if ($_SESSION['panier'] == null) {
        //     echo "ici premier if";
        //     $_SESSION['panier'][$Produits_id] = [];
        //     $_SESSION['panier'][$Produits_id]['taille'] = $taille;
        //     $_SESSION['panier'][$Produits_id]['quantity'] = $quantity;
        //     $_SESSION['panier'][$Produits_id]['prix'] = $prix;

        // } else {
        //     foreach (array_keys($_SESSION['panier']) as $id) {
        //         echo "ici foreach";
        //         if ($id == $Produits_id) {
        //             echo "ici if dans foreach";
        //             echo "<pre>";
        //             var_dump($_SESSION['panier']);
        //             echo "</pre>";
        //             echo "<pre>";
        //             var_dump($quantity);
        //             echo "</pre>";
        //             echo "ici id";
        //             echo "<pre>";
        //             var_dump($id);
        //             echo "</pre>";
        //             $_SESSION['panier']['quantity'] = ($_SESSION['panier']['quantity'] + $quantity);
        //             break;
        //         }
        //     }

        // }
    }

    public function displaypanier()
    {

        $ids = array_keys($_SESSION['panier']);

        if (empty($ids)) {
            return $panier = [];
        } else {
            $sql = 'SELECT `product_id`, product_type_description, `product_name`, `product_description`, `other_product_details`, product_image_1, product_image_2 FROM `products` NATURAL JOIN ref_product_types NATURAL JOIN products_image WHERE product_id IN (' . implode(',', $ids) . ')';

            $query = $this->pdo->prepare($sql);

            $query->execute();

            $panier = $query->fetchall();

            return $panier;
        }

        // $sql = 'SELECT products.product_id, product_type_id, product_name, product_description, other_product_details,
        // stock.price, products_image.product_image_1, products_image.product_image_2
        // FROM stock INNER JOIN products_image ON products_image.product_id = products.product_id INNER JOIN products ON stock.product_id = products.product_id WHERE products.product_id IN (' . implode(',', $ids) . ')';

        // $panier = $this->pdo->query($sql)->fetchall();

        // return $panier;

    }

    public function del($Produits_id)
    {
        unset($_SESSION['panier'][$Produits_id]);
    }

}
