<?php

namespace Framework;
use PDO;

class DatabaseConnector {

    public function db()
    {
        $dbHost = $GLOBALS['db_hostname'];
        $dbName = $GLOBALS['db_name'];
        $dbUsername = $GLOBALS['db_username'];
        $dbPassword = $GLOBALS['db_password'];
        $dbType = $GLOBALS['db_type'] ?? 'mysql';
        $dbPort = $GLOBALS['db_port'] ?? 3306;

        $dsn = "$dbType:host=$dbHost;port=$dbPort;dbname=$dbName;";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try {
            $pdo = new PDO($dsn, $dbUsername, $dbPassword, $options);
            return $pdo;
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

}