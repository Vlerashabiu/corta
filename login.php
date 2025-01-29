<?php
session_start();

// Connection to the database
$servername = "localhost";
$username = "root"; // your db username
$password = ""; // your db password
$dbname = "corta"; // your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) { // Verify the hashed password
            $_SESSION['email'] = $row['email'];
            $_SESSION['role'] = $row['role'];

            if ($row['role'] == 'admin') {
                header("Location: admin_dashboard.php"); // Redirect to admin dashboard
            } else {
                header("Location: user_dashboard.php"); // Redirect to user dashboard
            }
        } else {
            echo "Invalid credentials.";
        }
    } else {
        echo "No user found with this email.";
    }

    $conn->close();
}
?>

