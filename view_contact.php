<?php
session_start();
include 'db.php';

class ContactMessage {
    private $conn;

    public function __construct(Database $db) {
        $this->conn = $db->getConnection();
    }

    public function getMessages() {
        $query = "SELECT * FROM messages ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->get_result();
    }
}

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$database = new Database();
$contactMessage = new ContactMessage($database);
$messages = $contactMessage->getMessages();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Messages</title>
    <link rel="stylesheet" href="view_contact.css">
</head>
<body>
    <header>
        <h1>Contact Messages</h1>
    </header>
    <main>
        <?php while ($row = $messages->fetch_assoc()): ?>
            <div class="message-box">
                <p><strong>Name:</strong> <?php echo htmlspecialchars($row['name']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($row['email']); ?></p>
                <p><strong>Message:</strong> <?php echo nl2br(htmlspecialchars($row['message'])); ?></p>
                <p><strong>Date:</strong> <?php echo $row['created_at']; ?></p>
                <hr>
            </div>
        <?php endwhile; ?>
    </main>
</body>
</html>
