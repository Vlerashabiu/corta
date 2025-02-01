<?php
session_start();

class SessionManager {
    public function __construct() {
        if (!$this->isAdmin()) {
            $this->redirectToLogin();
        }
    }

    public function isAdmin() {
        return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
    }

    private function redirectToLogin() {
        header("Location: login.php");
        exit();
    }
}

$session = new SessionManager();
?>

