<?php

    // session_start();
    require_once 'layout_front.html.php';

    if (isset($_SESSION['customer'])) {
        $repere = "1";
    } else {
        $repere = "0";
    }

?>

<nav class="navbar container" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="">
      <img src="../../../template/media/Logo-Bateau-Louche.png" class=" is-64x64">
    </a>

    <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>

   <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start">
      <a class="navbar-item" href="allproduct.php">
        Boutique
      </a>

      <a class="navbar-item">
        Panier
      </a>

      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link">
          En savoir plus
        </a>

        <div class="navbar-dropdown">
          <a class="navbar-item">
            A propos
          </a>
          <a class="navbar-item">
            Condition général de vente
          </a>
          <a class="navbar-item">
            Contact
          </a>
          <hr class="navbar-divider">
          <a class="navbar-item">
            Service après vente
          </a>
        </div>
      </div>
    </div>

    <div class="navbar-end">
      <div class="navbar-item">
        <div class="buttons">
<?php if ($repere != "0") {?>
        <a class="button is-warning" href="profil.html.php">
           Profil
          </a> 
<?php } else {?>
         <a class="button is-warning" href="inscription.html.php">
           Inscription
          </a> 
<?php } ?>         


<?php if ($repere != "0") {?>
     <a class="button is-light" href="deconnexion.html.php">
        Deconnexion
      </a>
<?php
} else {?>
        <a class="button is-light" href="connection.html.php">
            Connexion
          </a>
<?php
    }
?>
        </div>
      </div>
    </div>
  </div>
</nav>
<body>