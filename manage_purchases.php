<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];  
$role = $_SESSION['role'];

include 'db.php';  

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $result = $conn->query("SELECT o.id AS order_id, o.order_date, o.status, oi.product_id, p.name AS product_name, oi.quantity, oi.price, c.name AS customer_name 
                            FROM orders o 
                            JOIN order_items oi ON o.id = oi.order_id 
                            JOIN products p ON oi.product_id = p.id 
                            JOIN customers c ON o.customer_id = c.id 
                            ORDER BY o.id DESC");

    if ($result->num_rows > 0) {
        echo "<h2>Order List</h2>";
        echo "<table>";
        echo "<tr><th>Order ID</th><th>Customer Name</th><th>Product Name</th><th>Quantity</th><th>Price</th><th>Status</th><th>Action</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['order_id'] . "</td>";
            echo "<td>" . htmlspecialchars($row['customer_name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['product_name']) . "</td>";
            echo "<td>" . $row['quantity'] . "</td>";
            echo "<td>$" . number_format($row['price'], 2) . "</td>";
            echo "<td>" . htmlspecialchars($row['status']) . "</td>";
            echo "<td><form method='POST'><input type='hidden' name='order_id' value='" . $row['order_id'] . "'>
                  <button type='submit' class='btn-update'>Update Status</button></form></td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No orders found.</p>";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['order_id'])) {
        $order_id = $_POST['order_id'];
        $new_status = 'Shipped'; 

        $stmt = $conn->prepare("UPDATE orders SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $new_status, $order_id);
        
        if ($stmt->execute()) {
            echo "Order status updated successfully!";
        } else {
            echo "Error updating order status: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Purchases</title>
    <link rel="stylesheet" href="purchase.css">
</head>
<body>
   
<h2>Manage Purchases</h2>

<h4>Add Purchase</h4>
<form method="POST">
    <input type="hidden" name="action" value="add">
    <label>User ID:</label>
    <input type="number" name="user_id" required>
    <label>Product Name:</label>
    <input type="text" name="product_name" required>
    <label>Quantity:</label>
    <input type="number" name="quantity" required>
    <label>Total Price:</label>
    <input type="text" name="total_price" required>
    <button type="submit">Add Purchase</button>
</form>

<h4>Purchase List</h4>
<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>User ID</th>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Total Price</th>
            <th>Purchase Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        
        $result = $conn->query("SELECT * FROM purchases");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['user_id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['product_name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['quantity']) . "</td>";
            echo "<td>$" . htmlspecialchars($row['total_price']) . "</td>";
            echo "<td>" . htmlspecialchars($row['purchase_date']) . "</td>";
            echo "<td>
                    <form method='POST' style='display:inline-block;'>
                        <input type='hidden' name='action' value='update'>
                        <input type='hidden' name='id' value='" . htmlspecialchars($row['id']) . "'>
                        <input type='number' name='quantity' value='" . htmlspecialchars($row['quantity']) . "' required>
                        <input type='text' name='total_price' value='" . htmlspecialchars($row['total_price']) . "' required>
                        <button type='submit'>Update</button>
                    </form>
                    <form method='POST' style='display:inline-block;'>
                        <input type='hidden' name='action' value='delete'>
                        <input type='hidden' name='id' value='" . htmlspecialchars($row['id']) . "'>
                        <button type='submit' onclick='return confirm(\"Are you sure?\");'>Delete</button>
                    </form>
                  </td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>
</body>
</html>
