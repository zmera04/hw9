<?php

namespace app\core;

use PDO;
use PDOException;

trait Database
{

    private function connect()
    {
        $type = 'mysql';
        $server = 'localhost';
        $db = 'posts';
        $port = '8888';
        $charset = 'utf8mb4';

        $username = 'admin';
        $password = 'password';

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            //set the default fetch type
            //PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,/
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        $dsn = "$type:host=$server;dbname=$db;port=$port;charset=$charset";

        try {
            return new PDO($dsn, $username, $password, $options);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), $e->getCode());
        }
    }

    public function fetch($query) {
        $connectedPDO = $this->connect();
        $statementObject = $connectedPDO->query($query);
        //no params, one row
        return $statementObject->fetch();
    }

    public function fetchAll($query) {
        $connectedPDO = $this->connect();
        $statementObject = $connectedPDO->query($query);
        //no params, multiple rows
        return $statementObject->fetchAll();
    }

    public function queryWithParams($query, $data, $className = null) {
        $connectedPDO = $this->connect();

        $statementObject = $connectedPDO->prepare($query);
        $statementObject->execute($data);

        if ($className) {
            $statementObject->setFetchMode(PDO::FETCH_CLASS, $className);
        }

        $result = $statementObject->fetchAll();
        if (is_array($result) && count($result)) {
            return $result;
        }

        return false;
    }

    public function query($query)
    {
        $connectedPDO = $this->connect();
        $stm = $connectedPDO->query($query);

        $result = $stm->fetchAll();
        if (is_array($result) && count($result)) {
            return $result;
        }

        return false;
    }

}


