<?php
require_once "db.php"; 

class Dashboard {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getTotalUsers() {
        return $this->getCount("users");
    }

    public function getTotalProducts() {
        return $this->getCount("products");
    }

    public function getTotalNews() {
        return $this->getCount("news");
    }

    public function getTotalMessages() {
        return $this->getCount("contact_messages");
    }

    private function getCount($table) {
        $query = $this->conn->query("SELECT COUNT(*) as total FROM $table");
        $result = $query->fetch_assoc();
        return $result['total'] ?? 0;
    }
}
?>


