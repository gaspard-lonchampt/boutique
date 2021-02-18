<?php

namespace Models;


require_once 'libraries/Database.php';
require_once 'libraries/models/Model.php';



class Products extends Model
{
    protected $pdo;
    protected $table = "products";
}