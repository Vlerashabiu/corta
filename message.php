<?php
class Message {
    private $conn;

    public function __construct($db) {
        $this->conn = $db->getConnection();
    }

    public function insertMessage($name, $email, $message) {
        $stmt = $this->conn->prepare("INSERT INTO messages (name, email, message, created_at) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("sss", $name, $email, $message);

        if ($stmt->execute()) {
            return "Your message has been successfully sent!";
        } else {
            return "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>
