<?php

namespace Models;

class Panier extends Models {

    public function __construct() {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = array();
        }
    }

    public function add($Produits_id) {
        // $_SESSION['panier'][$Produits['product_id']] = 1;
        $_SESSION['panier'][$Produits_id] = 1;

    }


}