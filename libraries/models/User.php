<?php

namespace Models;


require_once 'libraries/Database.php';
require_once 'libraries/models/Model.php';

class User extends Model
{
    protected $table = "users";
}