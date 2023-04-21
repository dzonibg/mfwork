<?php

namespace Framework;

use PDO;
use Framework\DatabaseConnector;

class Model extends DatabaseConnector {

    public $tableName;
    public $keys;
    public $values;

    public function fetchAll() {
        return $this->db()->query("SELECT * FROM " . $this->tableName)->fetchAll();
    }

    public function index() {
        return $this->db()->query("SELECT * FROM " . $this->tableName)->fetchAll();
    }

    public function findById($id) {
        return $this->db()->query("SELECT * FROM " . $this->tableName . " WHERE id=" . $id)->fetch();
    }

    public function findByParameter($parameter, $value) {
        return $this->db()
            ->query("SELECT * FROM " . $this->tableName . " WHERE " . $parameter . " = " . $value)->fetchAll();
    }

    public function insert($values) {
        $this->db()->query("INSERT INTO " . $this->tableName . " VALUES (" . $values . ");");
    }

    public function create($object) {
        $array = (array)$object;
        foreach ($array as $key => $value) {
            if (($key != "tableName") && ($key != 'values') && ($key != 'keys') && ($key != 'id')) {
                $this->addKey($key);
                $this->addValue($value);
            }
        }
        $this->keys = mb_substr($this->keys, 0, -2);
        $this->values = mb_substr($this->values, 0, -2);
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

        if ($GLOBALS['debug']) {
        echo "SQL Query: " . $query;
    }
        $this->db()->query($query);

    }
}