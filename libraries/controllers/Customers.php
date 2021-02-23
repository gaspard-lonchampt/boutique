<?php

namespace Controllers;

class Customers extends Controllers
{
    protected $modelName = \Models\Customers::class;
    protected $pdo;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Inscription
     *
     * @return void
     */
    public function register()
    {

        if (isset($_POST['customer_submit'])) {

            $errors = [];

            $this->customer_email = htmlspecialchars($_POST['customer_email']);
            $this->customer_login = htmlspecialchars($_POST['customer_login']);
            $this->customer_password = $_POST['customer_password'];
            $this->customer_lastname = htmlspecialchars($_POST['customer_lastname']);
            $this->customer_firstname = htmlspecialchars($_POST['customer_firstname']);
            $this->customer_statut = htmlspecialchars($_POST['customer_statut']);
            $this->customer_organisation_or_person = htmlspecialchars($_POST['customer_organisation_or_person']);
            $this->customer_country = htmlspecialchars($_POST['customer_country']);
            $this->customer_city = htmlspecialchars($_POST['customer_city']);
            $this->customer_postcode = htmlspecialchars($_POST['customer_postcode']);
            $this->customer_state = htmlspecialchars($_POST['customer_state']);
            $this->customer_adress_line_1 = htmlspecialchars($_POST['customer_adress_line_1']);
            $this->customer_adress_line_2 = htmlspecialchars($_POST['customer_adress_line_2']);
            $this->customer_adress_line_3 = htmlspecialchars($_POST['customer_adress_line_3']);
            $this->customer_adress_line_4 = htmlspecialchars($_POST['customer_adress_line_4']);

            if (strlen($this->customer_login) > 60) {
                $errors[] = "L'identifiant doit faire moins de 60 caractères";
            }

            if ($this->customer_login == $this->customer_password) {
                $errors[] = "L'identifiant et le mot de passe doivent être différents";
            }

            if (strlen($this->customer_country) > 2 || is_numeric($this->customer_country)) {
                $errors[] = "Veuillez indiquer deux caractères maximum en lettre";
            }

            if (!is_numeric($this->customer_postcode)) {
                $errors[] = "Veuillez indiquer une suite
                de chiffre pour le code postal";
            }

            if (!preg_match(
                "#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$#",
                $this->customer_password
            )
            ) {
                $errors[] = "Le mot de passe doit contenir plus de 8 caractères,
                     doit contenir une majuscule, une majuscule,
                     un chiffre et un caractère spécial";
            }

            if ($this->model->checklogin($this->customer_login) == true) {
                $errors[] = "Cet identifiant est déjà prit,
                veuillez en choisir un autre";
            }

            

            if (count($errors) == 0) {

                $this->customer_password = password_hash(
                    $this->customer_password,
                    PASSWORD_DEFAULT
                );

                $this->model->register(
                    $this->customer_email,
                    $this->customer_login,
                    $this->customer_password,
                    $this->customer_lastname,
                    $this->customer_firstname,
                    $this->customer_statut,
                    $this->customer_organisation_or_person,
                    $this->customer_country,
                    $this->customer_city,
                    $this->customer_postcode,
                    $this->customer_state,
                    $this->customer_adress_line_1,
                    $this->customer_adress_line_2,
                    $this->customer_adress_line_3,
                    $this->customer_adress_line_4
                );
            } else {
                return $errors;
            }

        }
    }

}
