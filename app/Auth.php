<?php

namespace App;

use Exception;

class Auth extends Database
{
    /**
     * Attributes
     */
    private $id;
    private $username;

    /**
     * Auth constructor
     */
    public function __construct()
    {
        if(!self::check()) {
            self::redirect('login');
        }

        parent::__construct();
    }

    /**
     * Method to try log in user with passed data
     * @param string $username
     * @param string $password
     * @throws Exception
     */
    public function login(string $username, string $password): void
    {
        if(!$this->isUserExists($username)) {
            throw new Exception("Bad username or password, try again!");
        }

        if(!$this->isUserPasswordMatches($username, $password)) {
            throw new Exception("Bad username or password, try again!");
        }

        $_SESSION['id'] = $this->id;
        $_SESSION['username'] = $this->username;
        $_SESSION['logged'] = true;

        header('location: main.php');
    }

    /**
     * Method to logout
     */
    public function logout(): void
    {
        session_unset();
        session_destroy();

        header('location: login.php');
    }

    /**
     * Method to get auth data
     * @return array
     */
    public function user(): array
    {
        return [
            'id' => $_SESSION['id'],
            'username' => $_SESSION['username'],
        ];
    }

    /**
     * Method to check is user exists;
     * @param string $username
     * @return bool
     */
    private function isUserExists(string $username): bool
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
     * Method to check is user input password matches from hashed password from database;
     * @param string $username
     * @param string $password
     * @return bool
     */
    private function isUserPasswordMatches(string $username, string $password): bool
    {
        $sth = $this->dbh->prepare("SELECT id, username, password FROM users WHERE username = ?");
        $sth->execute([$username]);
        $data = $sth->fetch();
        
        if(password_verify($password, $data['password'])) {
            $this->id = $data['id'];
            $this->username = $data['username'];
            return true;
        }

        return false;
    }

    public static function check() {

        if(isset($_SESSION['logged']) && $_SESSION['logged'] === true) {
            return true;
        }

        return false;
    }

    public static function redirect(string $path = 'index')
    {
        header("location: ${path}.php");
    }
}
