<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];  
$role = $_SESSION['role'];

include 'db.php';  
$result = $conn->query("SELECT p.id AS purchase_id, p.purchase_date, p.total_price, pi.product_id, pr.name AS product_name, pi.quantity, pi.price, u.username AS customer_name
                        FROM purchases p 
                        JOIN purchase_items pi ON p.id = pi.purchase_id 
                        JOIN products pr ON pi.product_id = pr.id 
                        JOIN users u ON p.user_id = u.id 
                        ORDER BY p.id DESC");

if (!$result) {
    die("Error fetching purchases: " . $conn->error);
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

</form>


<h4>Purchase List</h4>
<table border="1">
    <thead>
        <tr>
            <th>Purchase ID</th>
            <th>Customer Name</th>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Purchase Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>

        <?php
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['purchase_id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['customer_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['product_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['quantity']) . "</td>";
                echo "<td>$" . number_format($row['price'], 2) . "</td>";
                echo "<td>" . htmlspecialchars($row['purchase_date']) . "</td>";
                echo "<td>
                        <form method='POST' style='display:inline-block;'>
                            <input type='hidden' name='purchase_id' value='" . htmlspecialchars($row['purchase_id']) . "'>
                            <button type='submit' class='btn-update'>Update Status</button>
                        </form>
            
                        <form method='POST' style='display:inline-block;'>
                            <input type='hidden' name='action' value='delete'>
                            <input type='hidden' name='id' value='" . htmlspecialchars($row['purchase_id']) . "'>
                            <button type='submit' onclick='return confirm(\"Are you sure?\");'>Delete</button>
                        </form>
                    </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No purchases found.</td></tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>
