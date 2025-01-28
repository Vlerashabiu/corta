<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'add') {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $added_by = $_SESSION['username'];

        $stmt = $conn->prepare("INSERT INTO news (title, content, added_by) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $title, $content, $added_by);
        if ($stmt->execute()) {
            echo "News added successfully!";
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage News</title>
</head>
<body>
    <h1>Manage News</h1>
    <form method="POST">
        <input type="hidden" name="action" value="add">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
        
        <label for="content">Content:</label>
        <textarea id="content" name="content" required></textarea>
        
        <button type="submit">Add News</button>
    </form>

    <h2>Existing News</h2>
    <?php
    $result = $conn->query("SELECT * FROM news");
    while ($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "<h3>{$row['title']}</h3>";
        echo "<p>{$row['content']}</p>";
        echo "<p>Added by: {$row['added_by']}</p>";
        echo "</div>";
    }
    ?>
</body>
</html>
