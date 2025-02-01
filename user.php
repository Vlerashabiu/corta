<?php
class User {
    private $isLoggedIn;

    public function __construct() {
        session_start(); 
        $this->isLoggedIn = isset($_SESSION['userLoggedIn']) ? $_SESSION['userLoggedIn'] : false;
    }

    public function isLoggedIn() {
        return $this->isLoggedIn;
    }

    public function login() {
        $_SESSION['userLoggedIn'] = true;
        $this->isLoggedIn = true;
    }

    public function logout() {
        session_unset();
        session_destroy();
        $this->isLoggedIn = false;
    }
}
?>
