<?php


namespace Models;


class Panier extends Models
{
    public function __construct(){
        if (!isset($_SESSION)){
            session_start();
        }
        if (!isset($_SESSION['panier'])){
            $_SESSION['panier'] = array();
        }
        parent::__construct();
    }

    public function addpanier($product_id){
        $_SESSION['panier'][$product_id] = 1;
    }
}