<?php

include_once('DatabaseConnection.class.php');

class ChangeLogs extends DatabaseConnection
{
    /**
     * Variable to hold all changes data;
     */
    private $data = [];

    /**
     * Constructor after class was created to get all data from database into property $data;
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Function to get all data from database;
     */
    public function getAllChanges()
    {
        $sth = $this->dbh->query("SELECT * FROM changes ORDER BY version DESC");
        $this->data = $sth->fetchAll(PDO::FETCH_ASSOC);

        return $this->data;
    }

    /**
     * Function to check is there any changelogs;
     */
    public function isDataEmpty()
    {
        if(!$this->data) {
            return true;
        }

        return false;
    }

    /**
     * Function to get current version of changelog;
     */
    public function getCurrentVersion()
    {
        if($this->data && $this->data[0]['version']) {
            return $this->data[0]['version'];
        }

        return 'v.0.0.0';
    }
}