<?php

namespace Models;


require_once 'libraries/Database.php';
require_once 'libraries/models/Model.php';



class Products extends Model
{
    protected $modelName = \Models\Products::class;
    protected $pdo;
    protected $table = "products";

    public function delete(int $id): void
    {

    }
}