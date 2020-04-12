<?php

trait DBExtends {

    /*
     *  Chainable methods, used to build a query.
     *  Set the query using setQuery().
     *
     *  Q U E R Y   S E T T E R S :
     */


    public function select() {
        Model::setQuery("SELECT * FROM {$this->tableName}");
        return $this;
    }

    public function where($field, $operator, $value) {
        Model::setQuery($this->query . " WHERE {$field} {$operator} {$value}");
        return $this;
    }

    public function orderBy($field, $type) {
        Model::setQuery($this->query . " ORDER BY {$field} {$type}");
        return $this;
    }

    public function asc($field) {
        Model::setQuery($this->query . " ORDER BY {$field} ASC");
        return $this;
    }

    public function desc($field) {
        Model::setQuery($this->query . " ORDER BY {$field} DESC");
        return $this;
    }

    public function limit($rows) {
        Model::setQuery($this->query . " LIMIT {$rows}");
        return $this;
    }


    /*
     *
     * Query getters:
     *
    */

    public function get() {
        return Model::db()->query($this->query)->fetch();
    }

    public function getAll() {
        return Model::db()->query($this->query)->fetchAll();
    }

    public function first() {
        Model::setQuery($this->query . " LIMIT 1");
        return Model::db()->query($this->query)->fetch();
    }

    public function find($id) {
        return Model::db()->query("SELECT * FROM {$this->tableName} WHERE id = {$id}")->fetch();
    }


    public function insert($keys, $values) {
        Model::db()->query("INSERT INTO {$this->tableName} ($keys) VALUES ($values)");
    }




}