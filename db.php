<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'corta';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
echo "Lidhja me data bazen eshte kryer me sukses!";
?>

