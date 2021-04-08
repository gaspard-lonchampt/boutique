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
        // echo "ici var_dump dans fonction add";
        // echo "<pre>";
        // var_dump($Produits_id);
        // echo "</pre>";
        // echo "<pre>";
        // var_dump($_SESSION['panier']);
        // echo "</pre>";

        if ($_SESSION['panier'] == null) {
            // echo "ici premier if";
            $_SESSION['panier'][$Produits_id] = [];
            $_SESSION['panier'][$Produits_id]['taille'] = $taille;
            $_SESSION['panier'][$Produits_id]['quantity'] = $quantity;
            $_SESSION['panier'][$Produits_id]['prix'] = $prix;

        } else {
            foreach (array_keys($_SESSION['panier']) as $id) {
                // echo "ici foreach";
                if ($id == $Produits_id) {
                    $quantity = $_SESSION['panier'][$Produits_id]['quantity'] + $quantity;
                    $_SESSION['panier'][$Produits_id]['quantity'] = $quantity;
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

    // public function montantTotal()
    // {
    //     $total = 0;
    //     for ($i = 1; $i <pre count($_SESSION['panier']); $i++) {
    //         $total += $_SESSION['panier'][$i]['quantity'] * $_SESSION['panier'][$i]['prix'];
    //     }
    //     return round($total, 2);
    // }

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

    public function displayCommand()
    {
        $requete = "SELECT * FROM orders WHERE customer_id = :customer_id";
        $requete = $this->pdo->prepare($requete);
        $requete->bindParam(':customer_id', $_SESSION['customer']['customer_id']);
        $requete->execute();

        $commande = $requete->fetchall();
        // echo "<pre>";
        // var_dump($commande);
        // echo "</pre>";


        // foreach ($commande as $commande) {
        //     $requete = "SELECT * FROM order_items WHERE order_id = :order_id";
        //     $requete = $this->pdo->prepare($requete);
        //     $requete->bindParam(':order_id', $commande['order_id']);
        //     $requete->execute();
        //     $item = $requete->fetchall();
        //     // echo "<pre>";
        //     // var_dump($item);
        //     // echo "</pre>";
        // }

        return $commande;

    }

       public function displayCommandAdmin()
    {
        $requete = "SELECT * FROM orders";
        $requete = $this->pdo->prepare($requete);
        $requete->execute();

        $commande = $requete->fetchall();
        // echo "<pre>";
        // var_dump($commande);
        // echo "</pre>";


        // foreach ($commande as $commande) {
        //     $requete = "SELECT * FROM order_items WHERE order_id = :order_id";
        //     $requete = $this->pdo->prepare($requete);
        //     $requete->bindParam(':order_id', $commande['order_id']);
        //     $requete->execute();
        //     $item = $requete->fetchall();
        //     // echo "<pre>";
        //     // var_dump($item);
        //     // echo "</pre>";
        // }

        return $commande;

    }

    public function insertCommand()
    {
        $requete = "INSERT INTO orders
                (customer_id,
                 order_status_code,
                 date_order_placed,
                 order_details)
                VALUES
                (:customer_id,
                 :order_status_code,
                 :date_order_placed,
                 :order_details)";

        $requete = $this->pdo->prepare($requete);

        $order_status_code = 1;
        date_default_timezone_set('Europe/Paris');
        @$date = date("Y-m-d H:i:s");
        $order_details = $this->montantTotal();

        $requete->bindParam(':customer_id', $_SESSION['customer']['customer_id']);
        $requete->bindParam(':order_status_code', $order_status_code);
        $requete->bindParam(':date_order_placed', $date);
        $requete->bindParam(':order_details', $order_details);

        $requete->execute();

        $id_commande = $this->pdo->lastInsertId();

        print $this->pdo->lastInsertId();

        $panier = $this->displaypanier();

        // echo "<pre>";
        // var_dump($panier);
        // echo "</pre>";

        foreach ($panier as $panier) {

            echo "<pre>";
            var_dump($panier);
            echo "</pre>";

            $requete = "INSERT INTO order_items
                (product_id,
                 order_id,
                 order_item_status_code,
                 order_item_quantity,
                 order_item_price,
                 other_order_item_details)
                VALUES
                (:product_id,
                 :order_id,
                 :order_item_status_code,
                 :order_item_quantity,
                 :order_item_price,
                 :other_order_item_details)";

            $requete = $this->pdo->prepare($requete);

            $product_id = $panier['product_id'];
            $product_quantity = $_SESSION['panier'][$panier['product_id']]['quantity'];
            $product_price = $_SESSION['panier'][$panier['product_id']]['prix'];
            $product_taille = $_SESSION['panier'][$panier['product_id']]['taille'];

            $requete->bindParam(':product_id', $product_id);
            $requete->bindParam(':order_id', $id_commande);
            $requete->bindParam(':order_item_status_code', $order_status_code);
            $requete->bindParam(':order_item_quantity', $product_quantity);
            $requete->bindParam(':order_item_price', $product_price);
            $requete->bindParam(':other_order_item_details', $product_taille);

            $requete->execute();

        }
        unset($_SESSION['panier']);
        die('Votre Commande à bien été ajouté');

        // for ($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++) {
        //     executeRequete("INSERT INTO details_commande (id_commande, id_produit, quantite, prix) VALUES ($id_commande, " . $_SESSION['panier']['id_produit'][$i] . "," . $_SESSION['panier']['quantite'][$i] . "," . $_SESSION['panier']['prix'][$i] . ")");
        // }

    }

    public function montantTotal()
    {
        $total = 0;
        $panier = $this->displaypanier();
        foreach ($panier as $panier) {
            $total += $_SESSION['panier'][$panier["product_id"]]['quantity'] * $_SESSION['panier'][$panier["product_id"]]['prix'];
        }
        return round($total, 2);
    }
}

// cecile.lemedo@logirem.fr quittance + contrat
