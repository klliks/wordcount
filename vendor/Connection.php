<?php

namespace vendor;

class Connection {

    protected $host = "127.0.0.1";
    protected $dbname = "test";
    protected $user = "root";
    protected $pass = "root";
    protected $bdh;

    function __construct() {

        try {

            $this->bdh = new \PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
        }
        catch (\PDOException $e) {

            echo $e->getMessage();
        }
    }
}