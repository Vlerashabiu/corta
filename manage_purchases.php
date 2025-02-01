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
    <header>
        <h1>Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
        <p>Role: <?php echo htmlspecialchars($role); ?></p>
        <a href="logout.php">Logout</a>
    </header>

    <main>
        <h2>Order Management</h2>

        <?php if (empty($orders)): ?>
            <p>No orders found.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer Name</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?php echo $order['order_id']; ?></td>
                            <td><?php echo htmlspecialchars($order['customer_name']); ?></td>
                            <td><?php echo htmlspecialchars($order['product_name']); ?></td>
                            <td><?php echo $order['quantity']; ?></td>
                            <td><?php echo "$" . number_format($order['price'], 2); ?></td>
                            <td><?php echo htmlspecialchars($order['status']); ?></td>
                            <td>
                                <?php if ($order['status'] !== 'Shipped'): ?>
                                    <form method="POST" action="">
                                        <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                                        <button type="submit" class="btn-update">Update to Shipped</button>
                                    </form>
                                <?php else: ?>
                                    <button disabled class="btn-disabled">Already Shipped</button>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </main>
</body>
</html>
