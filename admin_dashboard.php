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
            min-height: 100vh;
            background-color: #f5f5f5;
            color: #333;
        }

        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: white;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar a {
            text-decoration: none;
            color: white;
            margin: 10px 0;
            padding: 10px;
            display: block;
            border-radius: 5px;
        }

        .sidebar a:hover {
            background-color: #34495e;
        }

        .content {
            flex-grow: 1;
            padding: 20px;
            overflow-y: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #ecf0f1;
            border-bottom: 2px solid #bdc3c7;
        }

        .header h1 {
            font-size: 24px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .card {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .card h3 {
            margin-bottom: 10px;
        }

        .card p {
            font-size: 14px;
            color: #555;
        }
        .logout-btn {
        padding: 10px 15px;
        background-color:rgb(72, 98, 125);
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
        transition: background 0.3s ease;
      }

       .logout-btn:hover {
       background-color: #34495e;
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
