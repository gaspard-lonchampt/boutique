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

    public function add($Produits_id, $taille, $quantity)
    {
        // $_SESSION['panier'][$Produits['product_id']] = 1;
        array_push([$_SESSION['panier'][$Produits_id]], $taille, $quantity);
        // $_SESSION['panier'][$Produits_id] = 1;
    }

    public function displaypanier()
    {

        $ids = array_keys($_SESSION['panier']);

        // $sql = 'SELECT `product_id`, product_type_description, `product_name`, `product_description`, `other_product_details`, product_image_1, product_image_2 FROM `products` NATURAL JOIN ref_product_types NATURAL JOIN products_image WHERE product_id IN (' . implode(',', $ids) . ')';

        // $query = $this->pdo->prepare($sql);

        // $query->execute();

        // $panier = $query->fetchall();

        // return $panier;

        $sql = 'SELECT products.product_id, product_type_id, product_name, product_description, other_product_details,
        stock.price, products_image.product_image_1, products_image.product_image_2
        FROM stock INNER JOIN products_image ON products_image.product_id = products.product_id INNER JOIN products ON stock.product_id = products.product_id WHERE products.product_id IN (' . implode(',', $ids) . ')';

        $panier = $this->pdo->query($sql)->fetchall();

        return $panier;

    }

}
