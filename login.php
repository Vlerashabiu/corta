<?php
session_start();

$conn = new mysqli("localhost", "root", "", "your_database_name");

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    $sql = "SELECT id, username, password, role FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $username, $hashedPassword, $role);

    if ($stmt->fetch() && password_verify($password, $hashedPassword)) {
        $_SESSION["user_id"] = $id;
        $_SESSION["username"] = $username;
        $_SESSION["role"] = $role; 

        if ($role === "admin") {
            header("Location: admin_dashboard.php"); 
        } else {
            header("Location: user_dashboard.php"); 
        exit();
    } else {
        echo "Invalid email or password!";
    }

    $stmt->close();
}

$conn->close();
?>
