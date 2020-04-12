<?php

/*
 *  Used for integrated auth.
 *
 */

class User extends Model {

    public function __construct()
    {
        $this->tableName = "users";
    }

    public $id = NULL;
    public $name;
    public $password;
    public $role;
    public $email;


}