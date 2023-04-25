<?php

namespace Framework;

use PDO;

abstract class Model extends DatabaseConnector {

    public string $tableName;
    public string $keys = "";
    public string $values = "";
    public string $serializedValues = "";
    public string $serializedValuePreparations = "";
    protected array $keyValuePairs = [];
    protected array $preparedKeyValuePairs = [];
    protected array $columns = [];

    public function __construct() {
        $this->columns = [];
    }

    public function fetchAll(): array {
        return $this->db()->query("SELECT * FROM $this->tableName")->fetchAll();
    }

    public function index(): array {
        return $this->db()->query("SELECT * FROM $this->tableName")->fetchAll();
    }

    public function findById($id): array {
        $query = "SELECT * FROM  $this->tableName WHERE id= :id";

        $sql = $this->prepareQuery($query, [
            'id' => $id
        ]);
        return $sql->fetch();
    }

    public function delete($id): bool {
        $query = "DELETE FROM $this->tableName WHERE id = :id";
        $sql = $this->prepareQuery($query, [
            'id' => $id
        ]);
        return $sql->execute();
    }

    public function deleteAll(): bool {
        $query = "DELETE FROM $this->tableName";
        $sql = $this->prepareQuery($query, null);
        return $sql->execute();
    }

    public function findByParameter($parameter, $value): array {

        if (in_array($parameter, $this->columns)) {

        $query = "SELECT * FROM $this->tableName WHERE $parameter = :value";
        $sql = $this->prepareQuery($query, [
            'value' => $value
        ]);
        return $sql->fetchAll();
    }
        else throw new \Exception("Parameter doesn't exist!");
        // will refactor to caught exceptions
    }

    public function insert($values) {
        $this->db()->query("INSERT INTO " . $this->tableName . " VALUES (" . $values . ");");
    }

    public function create($object):int {
        $array = (array)$object;
        foreach ($array as $key => $value) {
            if
            (($key != "tableName") && ($key != 'values')
                && ($key != 'keys') && ($key != 'id')
                && ($key != 'serializedValues') && ($key != ':serializedValuePreparations')
                && ($value != ':serializedValuePreparations')
                && ($value != 'serializedValuePreparations')
                && ($key != 'serializedValuePreparations')
                &&  !is_array($key) && !is_array($value))
            {
                $this->addKey($key);
                $this->addValue($value);
                $this->preparedKeyValuePairs[":$key"] = $value;
                $this->keyValuePairs[$key] = $value;
            }
        }
        $this->keys = mb_substr($this->keys, 0, -2);
        $this->serializedValues = mb_substr($this->serializedValues, 0, -2);
        $this->serializedValuePreparations = mb_substr($this->serializedValuePreparations, 0, -2);

        return $this->store();
    }

    public function addKey($key):void {
        $this->keys = $this->keys . $key . ", ";
        $this->serializedValuePreparations = $this->serializedValuePreparations . ":$key, ";
    }

    public function addValue($value): void {
        $this->serializedValues = $this->serializedValues . "'" . $value . "', ";
    }

    public function store(): int {
        $query = "INSERT INTO $this->tableName ($this->keys) VALUES ($this->serializedValuePreparations)";
        $sql = $this->prepareQuery($query, $this->keyValuePairs);

        if ($GLOBALS['debug']) {
        echo "SQL Query: " . $query;
    }
        return $sql->rowCount();

    }
}