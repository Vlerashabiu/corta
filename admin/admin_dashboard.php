<?php
session_start();

$_SESSION['role'] = 'admin';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Welcome to the Admin Dashboard</h1>
    <p>Manage your site and users here.</p>
    
 
    <a href="manage_users.php">Manage Users</a> 
    <a href="view_contact_messages.php">View Contact Messages</a>  
    <a href="add_product.php">Add New Product</a>  
    <a href="logout.php">Logout</a>
</body>
</html> 

