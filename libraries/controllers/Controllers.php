<?php

namespace Controllers;

/**
 * Controllers est la classe abstraite qui définit la connexion à la bdd et le chemin générique pour instancier le model qui correspond au controleur 
 */
abstract class Controllers
{

    protected $modelName;
    protected $pdo;

    public function __construct() 
    {
        $this->model = new $this->modelName();
        $this->pdo = \Database::getPdo();
    }

}
