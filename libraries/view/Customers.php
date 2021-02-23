<?php

    namespace View;

    class Customers
    {

        /**
         * Affichage formulaire d'inscription des clients
         *
         * @return void
         */
        public function form()
        {

        ?>

        <form action="inscription.php" method="POST" >

            <div class="register_form">
                <label for="customer_email">Email :</label>
                <input type="email" class="register_form"
                id="customer_email"
                name="customer_email" >
            </div>

            <div class="register_form">
                <label for="customer_login">Login :</label>
                <input type="text" class="register_form"
                id="customer_login"
                name="customer_login" >
                <?php // if(isset($error_login)){ echo $error_login ;} ?>
            </div>

            <div class="register_form">
                <label for="customer_password">Mot de passe : </label>
                <input type="password" class="register_form"
                id="customer_password"
                name="customer_password" >
            </div>

            <div class="register_form">
                <label for="customer_lastname">Nom : </label>
                <input type="text" class="register_form"
                id="customer_lastname"
                name="customer_lastname" >
            </div>

            <div class="register_form">
                <label for="customer_firstname">Prenom : </label>
                <input type="text" class="register_form"
                id="customer_firstname"
                name="customer_firstname">
            </div>

            <div class="register_form">
                <label for="customer_statut"> Droit : </label>
                <input type="number" class="register_form"
                id="customer_statut"
                name="customer_statut" >
            </div>

            <div class="register_form">
                <label for="customer_organisation_or_person">
                Organisation ou personne : </label>
                <input type="text" class="register_form"
                id="customer_organisation_or_person"
                name="customer_organisation_or_person" >
            </div>


            <div class="register_form">
                <label for="customer_country">
                Pays (2 charactère max) : </label>
                <input type="text" class="register_form"
                id="customer_country"
                name="customer_country" >
            </div>

            <div class="register_form">
                <label for="customer_city">
                Ville : </label>
                <input type="text" class="register_form"
                id="customer_city"
                name="customer_city" >
            </div>

             <div class="register_form">
                <label for="customer_postcode">
                Code Postal : </label>
                <input type="text" class="register_form"
                id="customer_postcode"
                name="customer_postcode" >
            </div>

             <div class="register_form">
                <label for="customer_state">
                Etats, Métropole ou DOM TOM : </label>
                <input type="text" class="register_form"
                id="customer_state"
                name="customer_state" >
            </div>

             <div class="register_form">
                <label for="customer_adress_line_1">
                Adress 1: </label>
                <input type="text" class="register_form"
                id="customer_adress_line_1"
                name="customer_adress_line_1" >
            </div>

              <div class="register_form">
                <label for="customer_adress_line_2">
                Adresse 2 : </label>
                <input type="text" class="register_form"
                id="customer_adress_line_2"
                name="customer_adress_line_2" >
            </div>

              <div class="register_form">
                <label for="customer_adress_line_3">
                Adress 3: </label>
                <input type="text" class="register_form"
                id="customer_adress_line_3"
                name="customer_adress_line_3" >
            </div>

              <div class="register_form">
                <label for="customer_adress_line_4">
                Adress 4: </label>
                <input type="text" class="register_form"
                id="customer_adress_line_4"
                name="customer_adress_line_4" >
            </div>


            <!-- Confirmation du password à faire -->

            <!-- <div class="register_form">
                <label for="confirm_mdp">Confirmation de mot de passe : </label>
                <input type="password" class="register_form" id="confirm_mdp" name="confirm_pass" >
            </div>
            <?php // if(isset($error)){ echo $error ;} ?>
            <div> -->

                <input class="btn btn-outline-primary" type="submit" value="Envoyer"
                name="customer_submit">
            </div>

        </form>

        <!-- <?php if (count($errors) > 0): ?>
            <div class="error">
            <?php foreach ($errors as $error): ?>
            <p><?php echo $error ?></p>
            <?php endforeach?>
            </div>
        <?php endif?> -->

        <?php
            }

            }

        ?>
