<?php

namespace Controllers;

abstract class Controllers
{

    protected $modelName;

    public function __construct () {
        $this->model = new $this->modelName();
    }

}
