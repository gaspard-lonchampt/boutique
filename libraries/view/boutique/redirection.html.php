<?php

require_once '../../autoload.php';
require_once 'layout_front.html.php';
require_once 'header.html.php'; 

var_dump($_SESSION['customer']['customer_statut']);
?>


<div class="box">
<h1 class="has-text-centered has-text-danger mt-6">
Vous devez être connecté pour accèder à cette page</h1>
</div>



<?php

require_once 'footer.html.php';
