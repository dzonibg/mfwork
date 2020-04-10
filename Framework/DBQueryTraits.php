<?php

trait DBQueryTraits {

    /*
     *  Chainable methods, used to build a query.
     *  Set the query using setQuery().
     */

    public function find($id) {
        return Model::setQuery("SELECT * FROM test WHERE id = {$id}");
    }

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

    public function Ascending($field) {
        Model::setQuery($this->query . " ORDER BY {$field} ASC");
        return $this;
    }

    public function Descending($field) {
        Model::setQuery($this->query . " ORDER BY {$field} DESC");
        return $this;
    }

    /*
     * Query getters:
    */

    public function get() {
        return Model::db()->query($this->query)->fetch();
    }

    public function getAll() {
        return Model::db()->query($this->query)->fetchAll();
    }

    public function show() {
        echo Model::showQuery();
    }

    public function insert($keys, $values) {
        Model::db()->query("INSERT INTO {$this->tableName} ($keys) VALUES ($values)");
    }




}