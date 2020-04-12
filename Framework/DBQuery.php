<?php
require "DBQueryTraits.php";
class Model {

    use DBExtends;
    protected $tableName;
    private $keys;
    private $values;
    private $query;
/*
 *  PDO CLASS
 */
    public function db()
    {
        $host = $GLOBALS['db_hostname'];
        $db = $GLOBALS['db_name'];
        $user = $GLOBALS['db_username'];
        $pass = $GLOBALS['db_password'];

        $dsn = "mysql:host=$host;dbname=$db;";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try {
            $pdo = new PDO($dsn, $user, $pass, $options);
            return $pdo;
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
/*
 *
 *  QUERIES
 *
 */

    public function index() {
        return $this->db()->query("SELECT * FROM " . $this->tableName)->fetchAll();
    }

    public function all() {
        return $this->db()->query("SELECT * FROM " . $this->tableName)->fetchAll();
    }

    public function FindByParameter($parameter, $value) {
        return $this->db()
            ->query("SELECT * FROM " . $this->tableName . " WHERE " . $parameter . " = " . $value)->fetchAll();
    }


    public function create($object) {
//        $array = (array)$object;
        $array = get_object_vars($object);
        foreach ($array as $key => $value) {
//            if (($key != "tableName") && ($key != 'values') && ($key != 'keys') && ($key != 'id') && ($key != 'query')) {
                if (($key != "tableName") && ($key != 'values') && ($key != 'keys') && ($key != 'query')) {
                $this->addKey($key);
                $this->addValue($value);
            }
        }
        $this->keys = mb_substr($this->keys, 0, -2);
        $this->values = mb_substr($this->values, 0, -2);
        $this->store();
    }

    private function addKey($key)
    {
        $this->keys = $this->keys . $key . ", ";
    }

    private function addValue($value) {
        if ($value != NULL) {
            $this->values = $this->values . "'" . $value . "', ";
        } else {
            $this->values = $this->values . 'NULL, ';
        }
    }

    private function store() { // called by create
        $query = 'INSERT INTO ' . $this->tableName . ' (' . $this->keys . ')' . ' VALUES (' . $this->values . ');';

        if ($GLOBALS['debug']) {
        echo "SQL Query: " . $query;
    }
        $this->db()->query($query);

    }

    public function setQuery($query) {
        $this->query = $query;
        return $this;
    }

    public function showQuery() {
        return $this->query;
    }

}