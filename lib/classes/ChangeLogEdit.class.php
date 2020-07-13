<?php

include_once('DatabaseConnection.class.php');

class ChangeLogEdit extends DatabaseConnection
{
    /**
     * Attributes;
     */
    private $id;

    /**
     * Constructor to set editable id;
     */
    public function __construct($id)
    {
        parent::__construct();
        $this->id = $id;
    }

    /**
     * Method to get selected changelog version number;
     */
    public function getVersion() {
        $sth = $this->dbh->prepare("SELECT version FROM changes WHERE id = ?");
        $sth->execute([$this->id]);
        $data = $sth->fetch(PDO::FETCH_ASSOC);

        return $data['version'];
    }

    /**
     * Method to get selected changelog date number;
     */
    public function getDate()
    {
        $sth = $this->dbh->prepare("SELECT date FROM changes WHERE id = ?");
        $sth->execute([$this->id]);
        $data = $sth->fetch(PDO::FETCH_ASSOC);

        return $data['date'];
    }

    /**
     * Method to get selected changelog date number;
     */
    public function getChanges()
    {
        $sth = $this->dbh->prepare("SELECT datalist FROM changes WHERE id = ?");
        $sth->execute([$this->id]);
        $data = $sth->fetch(PDO::FETCH_ASSOC);

        return $data['datalist'];
    }

    /**
     * Method to update changelog data;
     */
    public function updateChanges($version, $date, $datalist)
    {
        $sth = $this->dbh->prepare("UPDATE changes SET version = ?, date = ?, datalist = ? WHERE id = ?");
        $sth->execute([$version, $date, $datalist, $this->id]);
    }

    /**
     * Method to delete selected changelog;
     */
    public function deleteChangelog()
    {
        $sth = $this->dbh->prepare("DELETE FROM changes WHERE id = ?");
        $sth->execute([$this->id]);
    }
}
