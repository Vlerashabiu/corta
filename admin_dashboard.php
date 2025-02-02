<?php
require_once "sessionManager.php";
require_once "dashboard.php";
require_once "db.php";

$db = new Database();
$conn = $db->getConnection();
$dashboard = new Dashboard($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    background-color: #f5f5f5;
    color: #333;
}

.sidebar {
    width: 20%;
    max-width: 250px;
    background-color: #2c3e50;
    color: white;
    padding: 2%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    position: fixed;
    left: 0;
    top: 0;
    height: 100%;
    transition: transform 0.3s ease-in-out;
}

.sidebar h2 {
    text-align: center;
    margin-bottom: 2rem;
}

.sidebar a {
    text-decoration: none;
    color: white;
    margin: 1rem 0;
    padding: 1rem;
    display: block;
    border-radius: 5px;
}

.sidebar a:hover {
    background-color: #34495e;
}

.content {
    flex-grow: 1;
    padding: 2%;
    margin-left: 20%;
    transition: margin-left 0.3s ease-in-out;
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 2%;
    background-color: #ecf0f1;
    border-bottom: 2px solid #bdc3c7;
}

.header h1 {
    font-size: 1.5rem;
}

.logout-btn {
    padding: 0.8rem 1rem;
    background-color: rgb(72, 98, 125);
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1rem;
    transition: background 0.3s ease;
}

.logout-btn:hover {
    background-color: #34495e;
}

.cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(15rem, 1fr));
    gap: 1.5rem;
    margin-top: 2rem;
}

.card {
    background-color: white;
    padding: 1.5rem;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.card h3 {
    margin-bottom: 1rem;
    font-size: 1.2rem;
}

.card p {
    font-size: 1rem;
    color: #555;
}

@media (max-width: 768px) {
    .sidebar {
        transform: translateX(-100%);
        position: absolute;
        width: 60%;
        max-width: 250px;
    }

    .content {
        margin-left: 0;
        padding: 5%;
    }

    .sidebar.active {
        transform: translateX(0);
    }

    .menu-toggle {
        display: block;
        position: absolute;
        top: 1rem;
        left: 1rem;
        background-color: #2c3e50;
        color: white;
        padding: 0.8rem;
        border: none;
        cursor: pointer;
    }
}

    </style>
</head>
<body>
    <div class="sidebar">
        <div>
            <h2>Admin Dashboard</h2>
            <a href="manage_users.php">Manage Users</a>
            <a href="manage_products.php">Manage Products</a>
            <a href="manage_news.php">Manage News</a>
            <a href="view_contact.php">View Contact</a>
            <a href="manage_purchases.php">Manage Purchases</a> 
        </div>
    </div>

    <div class="content">
        <div class="header">
            <h1>Welcome, Admin</h1>
            <div>
            <button class="logout-btn" onclick="window.location.href='logout.php'">Log out</button>
        </div>
        </div>

        <div class="cards">
            <div class="card">
                <h3>Users</h3>
                <p>Total: <?php echo $dashboard->getTotalUsers(); ?></p>
            </div>
            <div class="card">
                <h3>Products</h3>
                <p>Total: <?php echo $dashboard->getTotalProducts(); ?></p>
            </div>
            <div class="card">
                <h3>News</h3>
                <p>Total: <?php echo $dashboard->getTotalNews(); ?></p>
            </div>
            <div class="card">
                <h3>Messages</h3>
                <p>Total: <?php echo $dashboard->getTotalMessages(); ?></p>
            </div>
        </div>
    </div>
</body>
</html>