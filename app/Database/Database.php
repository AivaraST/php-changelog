<?php
namespace App\Database;

class Database
{
    /**
     * DB Handler;
     */
    protected $dbh;

    /**
     * Database constructor.
     */
    public function __construct()
    {
        try {
            $this->dbh = new \PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASSWORD."");
        } catch (\PDOException $e) {
            die("Negalime prisijungti prie duomenų bazės.<br>Praneškite apie tai administracijai.<br>{$e->getMessage()}");
        }
    }
}
