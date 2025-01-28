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
        $description = $_POST['description'];
        $image_url = $_POST['image_url'];
        $date = date('Y-m-d');

        $stmt = $conn->prepare("INSERT INTO news (title,description,image_url, date) VALUES (?, ?, ?,?)");
        $stmt->bind_param("ssss", $title, $description, $image_url, $date);
        if ($stmt->execute()) {
            echo "<p style='color:green;'>News added successfully!</p>";
        } else {
            echo "<p style='color:red;'>Error: " . $conn->error . "</p>";
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
        
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>
        
        <label for="image_url">Image URL:</label>
        <input type="text" id="image_url" name="image_url" required>

        <button type="submit">Add News</button>
    </form>

    <h2>Existing News</h2>
    <?php

   $result = $conn->query("SELECT * FROM news");
    if ($result && $result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          echo "<div>";
          echo "<h3>{$row['title']}</h3>";
          echo "<p>{$row['description']}</p>";
          echo "<img src='{$row['image_url']}' alt='News Image' style='width:100px; height:auto;'>";
          echo "<p>Published on: {$row['date']}</p>";  
          echo "</div>";
       }
    } else {
       echo "<p>No news available.</p>";
      }
   ?>
</body>
</html>

