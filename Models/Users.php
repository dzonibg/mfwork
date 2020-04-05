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

    public function create(Users $user) {
        $array = (array)$user;
        foreach ($array as $key => $value) {
            if (($key != "tableName") && ($key != 'values') && ($key != 'keys') && ($key != 'id')) {
                $this->addKey($key);
                $this->addValue($value);
            }
        }
        $this->keys = mb_substr($this->keys, 0, -2);
        $this->values = mb_substr($this->values, 0, -2);
        print $this->keys;
        print $this->values;
        $this->store();
    }

    public function addKey($key) {
        $this->keys = $this->keys . $key . ", ";
    }

    public function addValue($value) {
        $this->values = $this->values . "'" . $value . "', ";
    }

    public function store() {
        $query = 'INSERT INTO ' . $this->tableName . ' (' . $this->keys . ')' . ' VALUES (' . $this->values . ');';
        echo $query;
        $this->db()->query($query);

    }

}