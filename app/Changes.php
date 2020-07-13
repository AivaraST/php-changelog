<?php

namespace App;

class Changes extends Database
{
    /**
     * Properties
     */
    private $data = [];
    protected $id;

    /**
     * Constants
     */
    const changeTypes = [
        ['sql_key_name' => 'added]',    'view_name' => 'Added',      'css_class' => 'added'],
        ['sql_key_name' => '[updated]', 'view_name' => 'Updated',    'css_class' => 'updated'],
        ['sql_key_name' => '[fixed]',   'view_name' => 'Fixed',      'css_class' => 'fixed'],
        ['sql_key_name' => '[removed]', 'view_name' => 'Removed',    'css_class' => 'removed'],
    ];

    /**
     * Changes constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Method to get all data from database
     * @return array
     */
    public function findAll(): array
    {
        $sth = $this->dbh->query("SELECT * FROM changes ORDER BY version DESC");
        $this->data = $sth->fetchAll(\PDO::FETCH_ASSOC);

        return $this->data;
    }

    /**
     * method to get one log at the time;
     * @param int $id
     * @return array
     */
    public function findOne(int $id): array
    {
        $sth = $this->dbh->prepare("SELECT * FROM changes WHERE id = ? LIMIT 10");
        $sth->execute([$id]);
        $single = $sth->fetch(\PDO::FETCH_ASSOC);

        if($single) {
            $this->id = $single['id'];
        }

        return $single;
    }

    /**
     * Method to get current version
     */
    public function getCurrentVersion(): string
    {
        if(!empty($this->data) && isset($this->data[0]['version'])) {
            return $this->data[0]['version'];
        }

        return 'v.0.0.0';
    }
}