<?php

class Users extends Model {

    public function __construct()
    {
        $this->tableName = "test";
    }

    public $id = "NULL";
    public $name;
    public $password;
    public $email;

    public function index()
    {

    }

}