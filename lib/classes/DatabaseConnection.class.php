<?php
include_once(dirname(__DIR__).'/configs/mysql.config.php');



// Create class with actions;

class DatabaseConnection {
    protected $dbh;
    public function __construct() {

        try {

            $this->dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASSWORD."");

        } catch (PDOException $e) {

            die("Negalime prisijungti prie duomenų bazės.<br>Praneškite apie tai administracijai.<br>{$e->getMessage()}");

        }

    }

}