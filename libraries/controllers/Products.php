<?php

namespace Controllers;


class Products extends Controllers
{
    protected $modelName = \models\Products::class;

    public function delete() {
        echo "Test fonction dans controllers";
    }

}