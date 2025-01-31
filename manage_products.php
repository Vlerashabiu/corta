<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];  
$role = $_SESSION['role'];

include 'db.php';  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'add') {
        $name = $_POST['name'];
        $price = $_POST['price'];

        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $image_tmp_name = $_FILES['image']['tmp_name'];
            $image_name = $_FILES['image']['name'];
            $image_size = $_FILES['image']['size'];
            $image_ext = pathinfo($image_name, PATHINFO_EXTENSION);

            $new_image_name = uniqid('', true) . '.' . $image_ext;
            $upload_directory = 'uploads/';  

            
            if (in_array($image_ext, ['png', 'jpg', 'jpeg'])) {
                if (move_uploaded_file($image_tmp_name, $upload_directory . $new_image_name)) {
                    $image_url = $upload_directory . $new_image_name;
                } else {
                    echo "Gabim gjatë ngarkimit të imazhit.";
                    $image_url = '';  
                }
            } else {
                echo "Përzgjedhni një imazh PNG, JPG ose JPEG.";
                $image_url = '';  
            }
        } else {
            
            $image_url = 'uploads/foto2.png';  
        }

       
        $stmt = $conn->prepare("INSERT INTO products (name, price, image, added_by) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sdss", $name, $price, $image_url, $_SESSION['username']); 
        
        if ($stmt->execute()) {
            echo "Product added successfully!";
        } else {
            echo "Error: " . $conn->error;
        }
    }
    if (isset($_POST['delete_id'])) {
        $delete_id = $_POST['delete_id'];
        $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
        $stmt->bind_param("i", $delete_id);
    
        if ($stmt->execute()) {
            echo "Product deleted successfully!";
        } else {
            echo "Error deleting product: " . $conn->error;
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
    <link rel="stylesheet" href="products.css">
</head>
<body>
    <h1>Manage Products</h1>

    <form method="POST" enctype="multipart/form-data">
        <h2>Add New Product</h2>
        <input type="hidden" name="action" value="add">
        
        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step="0.01" required>
 
        <label for="image">Product Image (optional):</label>
        <input type="file" id="image" name="image" accept="image/png, image/jpeg">
        <br><br>

        <button type="submit">Add Product</button>
    </form>

    <?php
    $result = $conn->query("SELECT id, name, price, image FROM products ORDER BY id DESC");

    if ($result->num_rows > 0) {
        echo "<h2>Product List</h2>";
        echo "<table>";
        echo "<tr><th>Image</th><th>Name</th><th>Price</th><th>Action</th></tr>";
    
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td><img src='" . $row['image'] . "' alt='Product Image' width='50'></td>";
            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
            echo "<td>$" . number_format($row['price'], 2) . "</td>";
            echo "<td><form method='POST'><input type='hidden' name='delete_id' value='" . $row['id'] . "'>
                  <button type='submit' class='btn-delete'>Delete</button></form></td>";
            echo "</tr>";
        }
    
        echo "</table>";
    } else {
        echo "<p>No products found.</p>";
    }
    ?>


</body>
</html>
