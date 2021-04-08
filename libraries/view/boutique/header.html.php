<?php
    
    require_once 'layout_front.html.php';

    if (isset($_SESSION['customer'])) {
        $repere = "1";
    } else {
        $repere = "0";
    }

$itemsearch = new \Models\Products();
    if(isset($_GET['navbarsearch'])) {

        $tab = array();

        foreach ($_GET as $value){
            if ($value != 'Rechercher')
                array_push($tab, $value);
        }
        
        $navbarsearchProduits = $itemsearch->filtrenavbar($tab);

    }

?>

<nav class="navbar container" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
  <?php if (!isset($index)): ?>
    <a class="navbar-item" href="../../../accueil.php">
    <?php else: ?>
    <a class="navbar-item" href="accueil.php">
    <?php endif ?>
    <?php if (!isset($index)): ?>
      <img src="../../../template/media/Logo-Bateau-Louche.png" class=" is-64x64">
      <?php else: ?>
       <img src="template/media/Logo-Bateau-Louche.png" class=" is-64x64">
       <?php endif ?>
    </a>

    <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>

   <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start">
      <?php if (!isset($index)): ?>
      <a class="navbar-item" href="allproduct.php">
      <?php else: ?>
      <a class="navbar-item" href="libraries/view/boutique/allproduct.php">
      <?php endif ?>
        Boutique
      </a>

      <?php if (!isset($index)): ?>
      <a class="navbar-item" href="panier.php">
      <?php else: ?>
      <a class="navbar-item" href="libraries/view/boutique/panier.php">
      <?php endif ?>
        Panier
      </a>

       <!-- <a class="navbar-item">
        <form method="GET" action="">
        <input type="search" class="input is-small is-rounded" name="recherche" placeholder="recherche par couleur...">
        <input type="submit" value="Rechercher" name="navbarsearch">
        </form>
      </a> -->



<?php if (isset($_SESSION['customer']['customer_statut'])): ?>
  <?php if ($_SESSION['customer']['customer_statut'] == "2"): ?>
      <?php if (!isset($index)): ?>
      <a class="navbar-item" href="../admin/inventaire.html.php">
      <?php else: ?>
      <a class="navbar-item" href="libraries/view/admin/inventaire.html.php">
      <?php endif;?>
       Admin
     </a>
  <?php endif;?>
<?php endif;?>

    </div>

    <div class="navbar-end">
      <div class="navbar-item">
        <div class="buttons">
<?php if ($repere != "0") {?>
  <?php if (!isset($index)): ?>
        <a class="button is-warning" href="profil.html.php">
  <?php else: ?>
        <a class="button is-warning" href="libraries/view/boutique/profil.html.php">
  <?php endif ?>
           Profil
          </a>
<?php } else {?>
    <?php if (!isset($index)): ?>
         <a class="button is-warning" href="inscription.html.php">
    <?php else: ?>
          <a class="button is-warning" href="libraries/view/boutique/inscription.html.php">
    <?php endif ?>
           Inscription
          </a>
<?php }?>


<?php if ($repere != "0") {?>
    <?php if (!isset($index)): ?>
     <a class="button is-light" href="deconnexion.html.php">
     <?php else: ?>
     <a class="button is-light" href="libraries/view/boutique/deconnexion.html.php">
      <?php endif ?>
        Deconnexion
      </a>
<?php
} else {?>
        <?php if (!isset($index)): ?>
        <a class="button is-light" href="connection.html.php">
         <?php else: ?>
         <a class="button is-light" href="libraries/view/boutique/connection.html.php">
         <?php endif ?>
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