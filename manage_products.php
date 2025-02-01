<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

require_once 'db.php';
require_once 'product.php';
 
$db = new Database();
$product = new Product($db);

$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'add') {
        $name = $_POST['name'];
        $price = $_POST['price'];

        $image_url = 'uploads/foto2.png'; 

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
                }
            }
        }
            
        if ($product->addProduct($name, $price, $image_url, $username)) {
            echo "Product added successfully!";
        } else {
            echo "Error adding product.";
        }
    }

       
    if (isset($_POST['delete_id'])) {
        $delete_id = $_POST['delete_id'];
        if ($product->deleteProduct($delete_id)) {
            echo "Product deleted successfully!";
        } else {
            echo "Error deleting product.";
        }
    }
}

$products = $product->getProducts();
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

    <h2>Product List</h2>
    <?php if (!empty($products)) : ?>
        <table>
            <tr><th>Image</th><th>Name</th><th>Price</th><th>Action</th></tr>
            <?php foreach ($products as $row) : ?>
                <tr>
                    <td><img src="<?= htmlspecialchars($row['image']); ?>" alt="Product Image" width="50"></td>
                    <td><?= htmlspecialchars($row['name']); ?></td>
                    <td>$<?= number_format($row['price'], 2); ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="delete_id" value="<?= $row['id']; ?>">
                            <button type="submit" class="btn-delete">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else : ?>
        <p>No products found.</p>
    <?php endif; ?>
</body>
</html>
