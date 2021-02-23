<?php

namespace Models;

/**
 * Class regroupant les conditions avant d'éffectuer les fonctions clients
 */
class Customers extends Models
{
    protected $pdo;
    protected $table = "users";

    private $id;
    public $customer_email;
    public $customer_login;
    public $customer_password;
    public $customer_lastname;
    public $customer_firstname;
    public $customer_statut;
    public $customer_organisation_or_person;
    public $customer_country;
    public $customer_city;
    public $customer_postcode;
    public $customer_state;
    public $customer_adress_line_1;
    public $customer_adress_line_2;
    public $customer_adress_line_3;
    public $customer_adress_line_4;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {

        parent::__construct();

    }

    /**
     * Vérification de l'unicité du login client
     *
     * @return void
     */
    public function checklogin($customer_login)
    {
        $requete_same_login = $this->pdo->prepare(
            "SELECT * FROM customer WHERE customer_login = ?"
        );
        $requete_same_login->execute([$customer_login]);
        $loginExist = $requete_same_login->fetch();
        return $loginExist;
    }

    /**
     * Inscription du client
     *
     * @return void
     */
    public function register(
        $customer_email,
        $customer_login,
        $customer_password,
        $customer_lastname,
        $customer_firstname,
        $customer_statut,
        $customer_organisation_or_person,
        $customer_country,
        $customer_city,
        $customer_postcode,
        $customer_state,
        $customer_adress_line_1,
        $customer_adress_line_2,
        $customer_adress_line_3,
        $customer_adress_line_4
    ) {

        // echo "<pre>";
        // var_dump($this->pdo);
        // echo "</pre>";

        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";

        // echo "Ici fonction register dans controller";

        $requete = "INSERT INTO customer
                (customer_email,
                 customer_login,
                 customer_password,
                 customer_lastname,
                 customer_firstname,
                 customer_statut,
                 customer_organisation_or_person,
                 customer_country,
                 customer_city,
                 customer_postcode,
                 customer_state,
                 customer_adress_line_1,
                 customer_adress_line_2,
                 customer_adress_line_3,
                 customer_adress_line_4)
                VALUES
                (:customer_email,
                 :customer_login,
                 :customer_password,
                 :customer_lastname,
                 :customer_firstname,
                 :customer_statut,
                 :customer_organisation_or_person,
                 :customer_country,
                 :customer_city,
                 :customer_postcode,
                 :customer_state,
                 :customer_adress_line_1,
                 :customer_adress_line_2,
                 :customer_adress_line_3,
                 :customer_adress_line_4)";

        $requete = $this->pdo->prepare($requete);

        $requete->bindParam(':customer_email', $customer_email);
        $requete->bindParam(':customer_login', $customer_login);
        $requete->bindParam(':customer_password', $customer_password);
        $requete->bindParam(':customer_lastname', $customer_lastname);
        $requete->bindParam(':customer_firstname', $customer_firstname);
        $requete->bindParam(':customer_statut', $customer_statut);
        $requete->bindParam(
            ':customer_organisation_or_person',
            $customer_organisation_or_person
        );
        $requete->bindParam(':customer_country', $customer_country);
        $requete->bindParam(':customer_city', $customer_city);
        $requete->bindParam(':customer_postcode', $customer_postcode);
        $requete->bindParam(':customer_state', $customer_state);
        $requete->bindParam(
            ':customer_adress_line_1',
            $customer_adress_line_1
        );
        $requete->bindParam(
            ':customer_adress_line_2',
            $customer_adress_line_2
        );
        $requete->bindParam(
            ':customer_adress_line_3',
            $customer_adress_line_3
        );
        $requete->bindParam(
            ':customer_adress_line_4',
            $customer_adress_line_4
        );

        $requete->execute();
        echo "Insertion réussi";

    }

    public function connect()
    {
        $requete = $this->pdo->prepare(
            "SELECT * FROM utilisateurs WHERE customer_login = :login "
        );

        $requete->bindParam(':customer_login', $this->customer_login);

        $result = $requete->execute()->fetch();

        if ($result && password_verify($this->customer_password, $result['customer_password'])) {
            return $result;
        }

    }

    // public function update($id)
    // {
    //     if ($this->checkLogin() == 0) {

    //         $requete = $this->pdo->prepare("UPDATE utilisateurs
    //                     SET login = :newlogin,
    //                         password = :newpass,
    //                         nom = :newnom,
    //                         prenom = :newprenom,
    //                         age = :newage
    //                             WHERE id = :id "
    //         );

    //         $requete->bindParam(":newlogin", $this->login);
    //         $requete->bindParam(":newpass", $this->password);
    //         $requete->bindParam(":newnom", $this->nom);
    //         $requete->bindParam(":newprenom", $this->prenom);
    //         $requete->bindParam(":newage", $this->age);
    //         $requete->bindParam(":id", $id);

    //         $requete->execute();

    //         return '<p class ="valide"> Changement effectué </p>';

    //     } else {
    //         return '<p class="error"> Login déjà pris </p>';
    //     }

    // }

    public function getAllinfos()
    {
        $requete = $this->connexion->prepare("SELECT * FROM utilisateurs WHERE login = :login");
        $requete->bindParam(':login', $this->login);

        $requete->execute();

        $result = $requete->fetch();

        return $result;
    }

    public function getDroit()
    {
        $requete = $this->connexion->prepare("SELECT id_droit FROM utilisateurs WHERE login = :login");
        $requete->bindParam(':login', $this->login);

        $requete->execute();

        $result = $requete->fetch();

        return $result['id_droit'];
    }

}
