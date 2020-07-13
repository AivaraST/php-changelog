<?php

namespace App;

session_start();

class Auth extends Database
{
    /**
     * Attributes
     */
    private $id;

    /**
     * Function to try log in user with passed data;
     */
    public function loginUser($username, $password)
    {
        if(!($this->isUserExists($username) && $this->isUserPasswordMatches($username, $password))) {
            throw new \Exception("Bad username or password, try again!");
        } else {
            $_SESSION['id'] = $this->id;
            $_SESSION['username'] = $username;
            header('location: main.php');
        }
    }
    
    /**
     * Function to check is user exists;
     */
    private function isUserExists($username)
    {
        $sth = $this->dbh->prepare("SELECT username FROM users WHERE username = ?");
        $sth->execute([$username]);
        $data = $sth->fetch(\PDO::FETCH_ASSOC);
        
        if($data) {
            return true;
        }

        return false;
    }
    
    /**
     * Function to check is user input password matches from hashed password from database;
     */
    private function isUserPasswordMatches($username, $password)
    {
        $sth = $this->dbh->prepare("SELECT id, username, password FROM users WHERE username = ?");
        $sth->execute([$username]);
        $data = $sth->fetch();
        
        if(password_verify($password, $data['password'])) {
            $this->id = $data['id'];
            return true;
        }

        return false;
    }
}