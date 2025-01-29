<?php
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
    echo "Forma u dërgua!"; // Kjo do të shfaqet nëse formulari është dërguar me POST
    // Shiko të dhënat e dërguara
    var_dump($_POST);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password for security
    $role = $_POST['role'];

    $sql = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$password', '$role')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        header("Location: login.html"); // Redirect to login page after successful signup
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
