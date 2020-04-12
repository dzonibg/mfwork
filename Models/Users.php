<?php

class Users extends Model {

    public function __construct()
    {
        $this->tableName = "test";
    }

    public $id = "";
    public $name;
    public $password;
    public $email;


}