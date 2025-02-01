<?php
session_start();

class SessionManager {
    public static function checkAdmin() {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header("Location: login.php");
            exit();
        }
    }
}

SessionManager::checkAdmin();
?>
