<?php

namespace Controllers;

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
