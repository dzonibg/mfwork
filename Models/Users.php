<?php

namespace Models;
use Framework\Model;

class Users extends Model {

    public function __construct()
    {
        $this->tableName = "users";
        $this->columns = array_keys(get_object_vars($this));
    }

    public $id;
    public $name;
    public $password;
    public $email;


}