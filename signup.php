<?php
session_start();

$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "corta"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
    $role = 'user'; 

    $sql = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$password', '$role')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        header("Location: login.php"); 
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="signup.style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css2?family=Major+Mono+Display&display=swap" rel="stylesheet">
    <script src="validation.js" defer></script>
</head>
<body>
    <header class="navbar">
        <div class ="title">CORTA</div>
           <a href="home.html">Home</a>
           <a href="store.html">Store</a>
           <a href="contact.html">ContactUs</a>
           <a href="news.html">News</a>
          <button class="sign-up"><a href="signup.html">Sign up</a></button>
          <button class="log-in"> <a href="login.html">Log in</a></button>
    </header>

    <div class="photo">
        <img src="signuppic.jpeg" alt="">
    </div>

    <div class="signup-form">
        <h2>Sign up</h2>
        <h5>Create your account</h5>
        <form action="signup.php" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <span class="material-icons">person</span>
                <input type="text" name="username" id="username" placeholder="Username" required>
                 
                <label for="email">Email</label>
                <span class="material-icons">email</span>
                <input type="email" name="email" id="email" placeholder="Email" required>
        
                <label for="password">Password</label>
                <span class="material-icons">password</span>
                <input type="password" name="password" id="password" placeholder="Password" required>
        
                <label for="confirmPassword">Confirm Password</label>
                <span class="material-icons">password</span>
                <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password" required>
            </div>
        
            <button type="submit">Sign up</button>
            <div class="login">
                 Already have an account? <a href="login.html">Log In</a>
            </div>
        </form>
    </div>
   
    <footer class="site-footer">
        <div class="footer">
       <p> Copyright © 2024 - 2025 Corta, All Right Reserved.</p>
        </div>
    </footer>
</body>
</html>
