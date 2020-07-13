<?php

namespace App;

class Admin extends Changes
{
    /**
     * Admin constructor
     */
    public function __construct()
    {
        Auth::check();
        parent::__construct();
    }

    /**
     * Create new changelist item
     * @param string $version
     * @param string $date
     * @param string $datalist
     */
    public function create(string $version, string $date, string $datalist): void
    {
        $sth = $this->dbh->prepare('INSERT INTO changes (version, date, datalist) VALUES (?, ?, ?)');
        $sth->execute([$version, $date, $datalist]);

        header('location: main.php');
    }

    /**
     * Update changelist item
     * @param string $version
     * @param string $date
     * @param string $datalist
     */
    public function update(string $version, string $date, string $datalist): void
    {
        $sth = $this->dbh->prepare("UPDATE changes SET version = ?, date = ?, datalist = ? WHERE id = ?");
        $sth->execute([$version, $date, $datalist, $this->id]);

        header('location: main.php');
    }

    /**
     * Delete changelist item
     * @param int $id
     */
    public function delete(int $id): void
    {
        $sth = $this->dbh->prepare("DELETE FROM changes WHERE id = ?");
        $sth->execute([$id]);

        header('location: main.php');
    }
}
