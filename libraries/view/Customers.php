<?php

    namespace View;

    // require_once '../autoload.php';

    /**
     * Customers view class est un ensemble de fonction qui regroupe l'affichage du HTML pour la partie client
     */
    /**
     */
    class Customers
    {

        /**
         * Formulaire d'inscription des clients avec affichage des messages d'erreurs/réussite de l'utilisateur
         *
         * @return void
         */
        public function register_form($register_msg)
        {

        ?>

        <form class="box container m-6 is-flex-wrap-wrap" action="inscription.html.php" method="POST" >

            <?php

                        if (isset($register_msg)) {
                            if (count($register_msg) > 0) {
                            ?>

            <div class="error is-danger">
<?php

                    foreach ($register_msg as $msg) {
                        echo '<p class="has-text-danger has-text-centered">' . $msg . "</p>";
                    }
                }
            }
        ?>
            </div>

            <div class="field">
                <label class="label is-small"  for="customer_email">Email </label>
                <input type="email" class="input is-small"
                id="customer_email"
                name="customer_email" >
            </div>

            <div class="field">
                <label class="label is-small"  for="customer_login">Login </label>
                <input type="text" class="input is-small"
                id="customer_login"
                name="customer_login" >
                <?php // if(isset($error_login)){ echo $error_login ;} ?>
            </div>

            <div class="field">
                <label class="label is-small"  for="customer_password">Mot de passe  </label>
                <input type="password" class="input is-small"
                id="customer_password"
                name="customer_password" >
            </div>

            <div class="field">
                <label class="label is-small"  for="customer_lastname">Nom  </label>
                <input type="text" class="input is-small"
                id="customer_lastname"
                name="customer_lastname" >
            </div>

            <div class="field">
                <label class="label is-small"  for="customer_firstname">Prenom  </label>
                <input type="text" class="input is-small"
                id="customer_firstname"
                name="customer_firstname">
            </div>

            <div class="field">
                <label class="label is-small"  for="customer_organisation_or_person">
                Organisation ou personne  </label>
                <input type="text" class="input is-small"
                id="customer_organisation_or_person"
                name="customer_organisation_or_person" >
            </div>


            <div class="field">
                <label class="label is-small"  for="customer_country">
                Pays (2 charactère max)  </label>
                <input type="text" class="input is-small"
                id="customer_country"
                name="customer_country" >
            </div>

            <div class="field">
                <label class="label is-small"  for="customer_city">
                Ville  </label>
                <input type="text" class="input is-small"
                id="customer_city"
                name="customer_city" >
            </div>

             <div class="field">
                <label  class="label is-small" for="customer_postcode">
                Code Postal  </label>
                <input type="text" class="input is-small"
                id="customer_postcode"
                name="customer_postcode" >
            </div>

             <div class="field">
                <label  class="label is-small" for="customer_state">
                Etats, Métropole ou DOM TOM  </label>
                <input type="text" class="input is-small"
                id="customer_state"
                name="customer_state" >
            </div>

             <div class="field">
                <label  class="label is-small" for="customer_adress_line_1">
                Adresse 1 </label>
                <input type="text" class="input is-small"
                id="customer_adress_line_1"
                name="customer_adress_line_1" >
            </div>

              <div class="field">
                <label  class="label is-small" for="customer_adress_line_2">
                Adresse 2 </label>
                <input type="text" class="input is-small"
                id="customer_adress_line_2"
                name="customer_adress_line_2" >
            </div>

              <div class="field">
                <label  class="label is-small" for="customer_adress_line_3">
                Adresse 3 </label>
                <input type="text" class="input is-small"
                id="customer_adress_line_3"
                name="customer_adress_line_3" >
            </div>

              <div class="field">
                <label  class="label is-small" for="customer_adress_line_4">
                Adresse 4 </label>
                <input type="text" class="input is-small"
                id="customer_adress_line_4"
                name="customer_adress_line_4" >
            </div>


            <!-- Confirmation du password à faire -->

            <!-- <div class="register_form">
                <label for="confirm_mdp">Confirmation de mot de passe : </label>
                <input type="password" class="register_form" id="confirm_mdp" name="confirm_pass" >
            </div>
            <?php // if(isset($error)){ echo $error ;} ?>
            <!-- patate -->

            <div class="control">
                <input class="button is-warning" type="submit" value="Envoyer"
                name="customer_submit">
            </div>

        </form>

        <?php
            }

                /**
                 * Formulaire de connexion avec affichage des messages d'erreurs/réussite de l'utilisateur
                 *
                 * @param  mixed $connect_msg
                 * @return void
                 */
                public function connect_form($connect_msg)
                {
                ?>
            <form class="box container m-6 is-flex-wrap-wrap" action="connection.html.php" method="POST" >
                <?php

                            if (isset($connect_msg)) {
                                if (count($connect_msg) > 0) {
                                ?>
        <div class="error is-danger has-text-centered">
<?php
    foreach ($connect_msg as $msg) {
                        echo "<p>" . $msg . "</p>";
                    }
                }
            }
        ?>
    </div>

             <div class="field">
                <label class="label is-small" for="customer_login">Login </label>
                <input type="text" class="input is-small"
                id="customer_login"
                name="customer_login" >
                <?php // if(isset($error_login)){ echo $error_login ;} ?>
            </div>
            <div class="field">
                <label class="label is-small"  for="customer_password">Mot de passe  </label>
                <input type="password" class="input is-small"
                id="customer_password"
                name="customer_password" >
            </div>
            <div>
              <div class="control">
                <input class="button is-warning" type="submit" value="Envoyer"
                name="customer_submit">
            </div>
            </form>
            </div>
<?php

        }

        public function All_profil_display_with_update($All_infos, $column_name)
        {
            $customer_ = ['customer_', '_'];
            $space = ['', '&nbsp'];

            $update = new \controllers\Customers();

            echo "<table>";

            foreach ($column_name as $key => $column) {
                if ($column["COLUMN_NAME"] !== "customer_password") {
                    echo "<th>";
                    echo str_replace($customer_, $space, $column["COLUMN_NAME"]);

                    echo "</th>";
                }
            }
        ?>
            </tr>

        <?php
            foreach ($All_infos as $infos_key => $values) {
                        foreach ($column_name as $key => $column) {
                            if ($column["COLUMN_NAME"] !== "customer_password") {

                            ?>
                    <td><?php
    if ($column["COLUMN_NAME"] == "customer_statut") {
                        if ($values["customer_statut"] == 1) {
                            ?><p><?php echo "Utilisateur"; ?></p><?php
} else {
                            ?><p><?php echo "Administrateur"; ?></p><?php
}
                        ?><form class="box container m-6 is-flex-wrap-wrap" action="customer.html.php" method="POST">
                        <label for="customer_statut">Modifier le niveau de privilège :</label>
                            <select name="customer_statut">
                                <option value="1">Utilisateurs</option>
                                <option value="2">Administrateur</option>
                            </select>
                        <input type="submit" name="admin_submit_<?php echo $values["customer_id"]; ?>" class="register_form" value="Modifier">
                    </form>
                        <?php $update->updateStatut(@$_POST["customer_statut"], $values["customer_id"]);
                                            } else {
                                                ?><p><?php echo $values[$column["COLUMN_NAME"]]; ?></p><?php
    }
                    ?>
                    </td>
            <?php
                }
                            }
                            echo "</tr>";
                        }
                        echo "</table>";
                        echo "</form>";
                    }

                    public function One_profil_display($one_customer_info, $update_msg)
                    {
                            if (isset($update_msg)) {
        if (count($update_msg) > 0) {
        ?>
        <div class="has-text-centered">
            <?php

                        foreach ($update_msg as $msg) {
                            echo '<p class="has-text-danger">' . $msg . '</p>';
                        }

                }
                ?> </div> <?php
            }
                    ?>
           
            <div class="box container is-flex-direction-column is-align-content-center is-justify-content-center mt-6">
            <p>Nom :                     <?php echo $one_customer_info['customer_lastname'] ?></p>
            <form class="pt-3 is-flex-direction-column" action="profil.html.php" method="POST" >
                <label for="customer_lastname">Modifier le nom:</label>
                <input type="text" name="customer_lastname">
                <div class="pt-2">
                <input class="button is-small is-rounded is-warning" type="submit" value ="modifier" name ="lastname"></div>
                </div>
            </form>
            </div>

            <div class="box container">
            <p>Prénom :                          <?php echo $one_customer_info['customer_firstname'] ?></p>
            <form class="pt-3 is-flex-direction-column" action="profil.html.php" method="POST">
                <label for="customer_firstname">Modifier le prénom:</label>
                <input type="text" name="customer_firstname"><div class="pt-2">
                <input  class="button is-small is-rounded is-warning" type="submit" value ="modifier" name ="firstname"></div>
            </form>
            </div>
            <div class="box container">
            <p>Courriel :                                                                                                     <?php echo $one_customer_info['customer_email'] ?></p>
            <form class="pt-3 is-flex-direction-column" action="profil.html.php" method="POST">
                <label for="customer_email">Modifier le courriel:</label>
                <input type="text" name="customer_email"><div class="pt-2">
                <input class="button is-small is-rounded is-warning" type="submit" value ="modifier" name ="email"></div>
            </form>
            </div>

            <div class="box container">
            <p>Mot de passe</p>
            <form class="pt-3 is-flex-direction-column" action="profil.html.php" method="POST">
                <label for="customer_password">Modifier le mot de passe:</label>
                <input type="password" name="customer_password">
                <label for="customer_cpassword">Confirmer le mot de passe:</label>
                <input type="password" name="customer_cpassword"><div class="pt-2">
                <input class="button is-small is-rounded is-warning" type="submit" value ="modifier" name ="password">
            </div>
            </form>
            </div>

            <div class="box container">
            <p>Professionnel ou particulier :                                                                                                                                                                                     <?php echo $one_customer_info['customer_organisation_or_person'] ?></p>
            <form class="pt-3 is-flex-direction-column" action="profil.html.php" method="POST">
                <label for="customer_organisation_or_person">
                Modifier le statut : </label>
                <select name="customer_organisation_or_person">
                    <option value="Professionnel">Professionnel</option>
                    <option value="Particulier">Particulier</option>
                </select><div class="pt-2">
                <input class="button is-small is-rounded is-warning" type="submit" value ="modifier" name ="orga_or_person">
            </div>
            </form>
            </div>

            <div class="box container">
            <p>Pays :                                                                                     <?php echo $one_customer_info['customer_country'] ?></p>
            <form class="pt-3 is-flex-direction-column" action="profil.html.php" method="POST">
                <label for="customer_country">
                Modifier le pays (2 caractère max) : </label>
                <input type="text"
                name="customer_country" ><div class="pt-2">
                <input class="button is-small is-rounded is-warning" type="submit" value ="modifier" name ="country">
            </div>
            </form>
            </div>

            <div class="box container">
            <p>Ville :                                                                                         <?php echo $one_customer_info['customer_city'] ?></p>
            <form class="pt-3 is-flex-direction-column" action="profil.html.php" method="POST">
                <label for="customer_city">
                Modifier la ville : </label>
                <input type="text"
                name="customer_city" >
                <div class="pt-2">
                <input class="button is-small is-rounded is-warning" type="submit" value ="modifier" name ="city">
            </div>
            </form>
            </div>

<div class="box container">
            <p>Code postale :                                                                                                                     <?php echo $one_customer_info['customer_postcode'] ?></p>
            <form class="pt-3 is-flex-direction-column" action="profil.html.php" method="POST">
                <label for="customer_postcode">
                Modifier le code postale : </label>
                <input type="text"
                name="customer_postcode" ><div class="pt-2">
                <input class="button is-small is-rounded is-warning" type="submit" value ="modifier" name ="postcode"></div>
            </form></div>
<div class="box container">
            <p>Etats, Métropole ou DOM TOM  :                                                                                                                                                                                         <?php echo $one_customer_info['customer_state'] ?></p>
            <form class="pt-3 is-flex-direction-column" action="profil.html.php" method="POST">
                <label for="customer_state">
                Modifier l'Etat, métropole ou DOM TOM : </label>
                <input type="text"
                name="customer_state" ><div class="pt-2">
                <input class="button is-small is-rounded is-warning" type="submit" value ="modifier" name ="state"></div>
            </form></div>
<div class="box container">
            <p>Adresse N°1  :                                                                                                                         <?php echo $one_customer_info['customer_adress_line_1'] ?></p>
            <form class="pt-3 is-flex-direction-column" action="profil.html.php" method="POST">
                <label for="customer_adress_line_1">
                Modifier l'adresse N°1 : </label>
                <input type="text"
                name="customer_adress_line_1" ><div class="pt-2">
                <input class="button is-small is-rounded is-warning" type="submit" value ="modifier" name ="adress_1"></div>
            </form></div>
<div class="box container">
            <p>Adresse N°2  :                                                                                                                         <?php echo $one_customer_info['customer_adress_line_2'] ?></p>
            <form class="pt-3 is-flex-direction-column" action="profil.html.php" method="POST">
                <label for="customer_adress_line_2">
                Modifier l'adresse N°2 : </label>
                <input type="text"
                name="customer_adress_line_2" ><div class="pt-2">
                <input class="button is-small is-rounded is-warning" type="submit" value ="modifier" name ="adress_2"></div>
            </form></div>
<div class="box container">
            <p>Adresse N°3  :                                                                                                                         <?php echo $one_customer_info['customer_adress_line_3'] ?></p>
            <form class="pt-3 is-flex-direction-column" action="profil.html.php" method="POST">
                <label for="customer_adress_line_3">
                Modifier l'adresse N°3 : </label>
                <input type="text"
                name="customer_adress_line_3" ><div class="pt-2">
                <input class="button is-small is-rounded is-warning" type="submit" value ="modifier" name ="adress_3"></div>
            </form></div>

<div class="box container">
            <p>Adresse N°4  :                                                                                                                         <?php echo $one_customer_info['customer_adress_line_4'] ?></p>
            <form class="pt-3 is-flex-direction-column" action="profil.html.php" method="POST">
                <label for="customer_adress_line_4">
                Modifier l'adresse N°4 : </label>
                <input type="text"
                name="customer_adress_line_4" ><div class="pt-2">
                <input class="button is-small is-rounded is-warning" type="submit" value ="modifier" name ="adress_4">
            </div>
            </form>
             </div>
             
<?php

 

                    }
            
    // public function 

            }
