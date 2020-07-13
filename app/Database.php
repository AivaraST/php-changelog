<?php

namespace App;

class Database
{
    /**
     * Properties
     */
    protected $dbh;

    /**
     * Database constructor
     */
    public function __construct()
    {
        try {
            $this->dbh = new \PDO("mysql:host=".$_ENV['DB_HOST'].";dbname=".$_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']."");
            $this->dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            die("Negalime prisijungti prie duomenų bazės.<br>Praneškite apie tai administracijai.<br>{$e->getMessage()}");
        }
    }
}
