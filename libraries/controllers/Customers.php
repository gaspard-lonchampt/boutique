<?php

namespace Controllers;

/**
 * Classe qui regroupe les conditions à vérifier/paramètres à rentrer avant de lancer les fonctions sur le model
 */
class Customers extends Controllers
{
    protected $modelName = \models\Customers::class;
    protected $pdo;
    private $customer_id;

    public function __construct()
    {
        parent::__construct();
        $this->customer_email = @htmlspecialchars($_POST['customer_email']);
        $this->customer_login = @htmlspecialchars($_POST['customer_login']);
        $this->customer_password = @$_POST['customer_password'];
        $this->customer_lastname = @htmlspecialchars($_POST['customer_lastname']);
        $this->customer_firstname = @htmlspecialchars($_POST['customer_firstname']);
        $this->customer_statut = "1";
        $this->customer_organisation_or_person = @htmlspecialchars($_POST['customer_organisation_or_person']);
        $this->customer_country = @htmlspecialchars($_POST['customer_country']);
        $this->customer_city = @htmlspecialchars($_POST['customer_city']);
        $this->customer_postcode = @htmlspecialchars($_POST['customer_postcode']);
        $this->customer_state = @htmlspecialchars($_POST['customer_state']);
        $this->customer_adress_line_1 = @htmlspecialchars($_POST['customer_adress_line_1']);
        $this->customer_adress_line_2 = @htmlspecialchars($_POST['customer_adress_line_2']);
        $this->customer_adress_line_3 = @htmlspecialchars($_POST['customer_adress_line_3']);
        $this->customer_adress_line_4 = @htmlspecialchars($_POST['customer_adress_line_4']);

    }

    /**
     * Condition et transmission des paramètres avant de lancer inscription sur le model
     *
     * @return void
     */
    public function register()
    {

        if (isset($_POST['customer_submit'])) {

            $register_field = [];
            $register_msg = [];

            foreach ($_POST as $key => $value) {
                if ($value == "") {
                    array_push($register_field, $key);
                }
            }
            if (count($register_field) > 0) {
                $register_msg[] = "Des champs requis ne sont pas remplis";
                return $register_msg;
            }

            if (strlen($this->customer_login) > 60) {
                $register_msg[] = "L'identifiant doit faire moins de 60 caractères";
                return $register_msg;

            }

            if ($this->customer_login == $this->customer_password) {
                $register_msg[] = "L'identifiant et le mot de passe doivent être différents";
                return $register_msg;
            }

            if (strlen($this->customer_country) > 2 || is_numeric($this->customer_country)) {
                $register_msg[] = "Veuillez indiquer votre pays en deux lettres maximum";
                return $register_msg;
            }

            if (!is_numeric($this->customer_postcode)) {
                $register_msg[] = "Veuillez indiquer une suite
                de chiffre pour le code postal";
                return $register_msg;
            }

            if (!preg_match(
                "#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$#",
                $this->customer_password
            )
            ) {
                $register_msg[] = "Le mot de passe doit contenir plus de 8 caractères,
                    doit contenir une majuscule, une majuscule,
                    un chiffre et un caractère spécial";
                return $register_msg;
            }

            if ($this->model->getAllinfos($this->customer_login) == true) {
                $register_msg[] = "Cet identifiant est déjà prit,
                    veuillez en choisir un autre";
                return $register_msg;
            }

            if (count($register_msg) == 0) {

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
                $register_msg[] = "Inscription validé";
                return $register_msg;
            } else {
                return $register_msg;
            }

        }
    }

    /**
     * Condition avant de lancer connection sur le model
     *
     * @return string
     */
    public function connect()
    {
        if (isset($_POST['customer_submit'])) {

            $connect_msg = [];
            $this->customer_login = htmlspecialchars($_POST['customer_login']);
            $this->customer_password = $_POST['customer_password'];

            $customer_getAllinfos = $this->model->getAllinfos(
                $this->customer_login
            );

            if ($customer_getAllinfos == false) {
                $connect_msg[] = "Identifiant incorrect";
            }

            if ($customer_getAllinfos != false
                && !password_verify(
                    $this->customer_password,
                    $customer_getAllinfos['customer_password']
                )
            ) {
                $connect_msg[] = "Mot de passe incorrect";
            }

            if (count($connect_msg) == 0) {
                $this->customer_id = $customer_getAllinfos['customer_id'];
                $_SESSION['customer'] = $customer_getAllinfos;
                $connect_msg[] = "Connection réussi, redirection dans quelques secondes";
                header("Refresh:3");
                return $connect_msg;
            } else {
                return $connect_msg;
            }
        }

    }

    /**
     * Paramètre spécifique à rentrer puis lancement de la fonction sur le model pour afficher les infos utilisateurs
     *
     * @return void
     */
    public function All_profil_display()
    {
        $order = "customer_id ASC";
        $All_infos = $this->model->findAll($order);
        return $All_infos;
    }

    /**
     * Paramètre de la colonne  puis lancement de la fonction sur le model pour afficher les noms de colonnes de la base de donnée MySQL
     *
     * @return void
     */
    public function getColumnName()
    {
        $getColumnName = $this->model->getColumnName("customer");
        return $getColumnName;
    }

    public function One_profil_display($customer_login)
    {
        $one_customer_info = $this->model->getAllinfos($customer_login);
        return $one_customer_info;
    }

    public function updateStatut($value, $id)
    {
        $submit = "admin_submit_" . $id;
        if (isset($_POST[$submit])) {
            $this->model->updateStatut($value, $id);
            header('Location: customer.html.php');
            exit();
        }
    }
    
    /**
     * Modification du profil utilisateur par l'user, vérifie les conditions puis envoie au Model
     *
     * @return void
     */
    public function updateProfil()
    {
        $update_msg = [];

        if (isset($_POST['lastname'])) {
            if (empty($this->customer_lastname)) {
                $update_msg[] = "Veuillez remplir le champ à modifier";
                return $update_msg;
            } else {
                $column = "customer_lastname";
                $value = $this->customer_lastname;
                $id = $_SESSION['customer']['customer_id'];
                $this->model->updateProfil($column, $value, $id);
                header('Location: profil.html.php');
                exit();
            }
        }

        if (isset($_POST['firstname'])) {
            if (empty($this->customer_firstname)) {
                $update_msg[] = "Veuillez remplir le champ à modifier";
                return $update_msg;
            } else {
                $column = "customer_firstname";
                $value = $this->customer_firstname;
                $id = $_SESSION['customer']['customer_id'];
                $this->model->updateProfil($column, $value, $id);
                header('Location: profil.html.php');
                exit();
            }
        }

        if (isset($_POST['email'])) {
            if (empty($this->customer_email)) {
                $update_msg[] = "Veuillez remplir le champ à modifier";
                return $update_msg;
            }

            if (!preg_match("/^[a-zA-Z0-9.!#$%&'*+=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/", $_POST['customer_email'])) {
                $update_msg[] = "Veuillez entrer une adresse courriel valide";
                return $update_msg;
            }
            // \var_dump($_SESSION['customer']);
            if ($this->model->checkMail($_SESSION['customer']['customer_email']) == true) {
                $register_msg[] = "Ce courriel n'est pas disponible,
                    veuillez en choisir un autre";
                return $register_msg;
            } else {
                $column = "customer_email";
                $value = $this->customer_email;
                $id = $_SESSION['customer']['customer_id'];
                $this->model->updateProfil($column, $value, $id);
                header('Location: profil.html.php');
                exit();
            }
        }

        if (isset($_POST['orga_or_person'])) {
            if (empty($this->customer_organisation_or_person)) {
                $update_msg[] = "Veuillez remplir le champ à modifier";
                return $update_msg;
            } else {
                $column = "customer_organisation_or_person";
                $value = $this->customer_organisation_or_person;
                $id = $_SESSION['customer']['customer_id'];
                $this->model->updateProfil($column, $value, $id);
                header('Location: profil.html.php');
                exit();
            }
        }

        if (isset($_POST['country'])) {
            if (empty($this->customer_country)) {
                $update_msg[] = "Veuillez remplir le champ à modifier";
                return $update_msg;
            }

            if (strlen($this->customer_country) > 2) {
                $update_msg[] = "Deux caractères maximum";
                return $update_msg;
            } else {
                $column = "customer_country";
                $value = $this->customer_country;
                $id = $_SESSION['customer']['customer_id'];
                $this->model->updateProfil($column, $value, $id);
                header('Location: profil.html.php');
                exit();
            }
        }

        if (isset($_POST['city'])) {
            if (empty($this->customer_city)) {
                $update_msg[] = "Veuillez remplir le champ à modifier";
                return $update_msg;
            } else {
                $column = "customer_city";
                $value = $this->customer_city;
                $id = $_SESSION['customer']['customer_id'];
                $this->model->updateProfil($column, $value, $id);
                header('Location: profil.html.php');
                exit();
            }
        }

        if (isset($_POST['postcode'])) {
            if (empty($this->customer_postcode)) {
                $update_msg[] = "Veuillez remplir le champ à modifier";
                return $update_msg;
            } else {
                $column = "customer_postcode";
                $value = $this->customer_postcode;
                $id = $_SESSION['customer']['customer_id'];
                $this->model->updateProfil($column, $value, $id);
                header('Location: profil.html.php');
                exit();
            }
        }

    }

}
