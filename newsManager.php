<?php
class NewsManager {
    private $conn;

    public function __construct(Database $db) {
        $this->conn = $db->getConnection();
    }

    public function addNews($title, $description, $image_url) {
        $date = date('Y-m-d');
        $stmt = $this->conn->prepare("INSERT INTO news (title, description, image_url, date) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $title, $description, $image_url, $date);
        
        return $stmt->execute();
    }

    public function getAllNews() {
        $result = $this->conn->query("SELECT * FROM news");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>
