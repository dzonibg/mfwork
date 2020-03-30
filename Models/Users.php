<?php

class Users extends Model {

    public $tableName = 'test';

    public function index()
    {
        return $this->db()->query("SELECT * FROM test")->fetchAll();
    }

}