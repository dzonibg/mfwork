<?php

namespace Models;
use Framework\Model;

class Users extends Model {

    public function __construct()
    {
        $this->tableName = "users";
    }

    public $id;
    public $name;
    public $password;
    public $email;


}