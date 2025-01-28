<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include 'db.php'; 


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        if ($action === 'add') {
           
            $name = $_POST['name'];
            $price = $_POST['price'];
            $image = $_POST['image'];
            $added_by = $_SESSION['username'];

            $stmt = $conn->prepare("INSERT INTO products (name, price, image, added_by) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("sdss", $name, $price, $image, $added_by);
            if ($stmt->execute()) {
                echo "Product added successfully!";
            } else {
                echo "Error: " . $conn->error;
            }
        } elseif ($action === 'delete') {
          
            $id = $_POST['id'];

            $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
            $stmt->bind_param("i", $id);
            if ($stmt->execute()) {
                echo "Product deleted successfully!";
            } else {
                echo "Error: " . $conn->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
</head>
<body>
    <h1>Manage Products</h1>

    <form method="POST">
        <h2>Add New Product</h2>
        <input type="hidden" name="action" value="add">
        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step="0.01" required>

        <label for="image">Image URL:</label>
        <input type="text" id="image" name="image" required>

        <button type="submit">Add Product</button>
    </form>

    <h2>Existing Products</h2>
  
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Image</th>
                <th>Added By</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
          
            $result = $conn->query("SELECT * FROM products");
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['name']}</td>";
                echo "<td>\${$row['price']}</td>";
                echo "<td><img src='{$row['image']}' alt='{$row['name']}' style='width:50px;'></td>";
                echo "<td>{$row['added_by']}</td>";
                echo "<td>
                    <form method='POST' style='display:inline-block;'>
                        <input type='hidden' name='action' value='delete'>
                        <input type='hidden' name='id' value='{$row['id']}'>
                        <button type='submit'>Delete</button>
                    </form>
                </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
