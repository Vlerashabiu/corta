<?php

require_once "sessionManager.php";
require_once "db.php";
require_once "NewsManager.php";

$db = new Database();
$newsManager = new NewsManager($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'add') {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $image_url = $_POST['image_url'];
        $date = date('Y-m-d');

        if ($newsManager->addNews($title, $description, $image_url)) {
            echo "<p style='color:green;'>News added successfully!</p>";
        } else {
            echo "<p style='color:red;'>Error adding news.</p>";
        }
    }
}
$newsList = $newsManager->getAllNews();
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
    <?php if (!empty($newsList)) : ?>
        <?php foreach ($newsList as $news) : ?>
            <div>
                <h3><?= htmlspecialchars($news['title']); ?></h3>
                <p><?= htmlspecialchars($news['description']); ?></p>
                <img src="<?= htmlspecialchars($news['image_url']); ?>" alt="News Image" style="width:100px; height:auto;">
                <p>Published on: <?= htmlspecialchars($news['date']); ?></p>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>No news available.</p>
    <?php endif; ?>
</body>
</html>

