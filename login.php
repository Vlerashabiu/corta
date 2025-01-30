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
    $email = $_POST['email'];
    $password = $_POST['password'];

    
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        
        if (password_verify($password, $row['password'])) {
            
           
            $_SESSION['username'] = $row['username'];  
            $_SESSION['email'] = $row['email']; 
            $_SESSION['role'] = $row['role'];

            if ($row['role'] == 'admin') {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: index.php");
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="stylesheet" href="loginstyle.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Major+Mono+Display&display=swap" rel="stylesheet">
    
<body>
<header class="navbar">
    <div class ="title">CORTA</div>
       <a href="home.html">Home</a>
       <a href="store.html">Store</a>
       <a href="contact.html">ContactUs</a>
       <a href="news.html">News</a>
      </div>
        <button class="sign-up"><a href="signup.html">Sign up</a></button>
        <button class="log-in"> <a href="login.html">Log in</a></button>
</header>

    <div class="pic">
        <img src="loginpic.jpg" alt="">
    </div>
   <div class="login-form">
    <h2>Log In</h2>
    <form id="form" method="POST">
        <div class="form-group">
            <label for="email">Email Address</label>
            <span class="material-icons" >email</span>
                
         <input type="email" name="email" id="email" placeholder="Enter your email" required>
            <label for="password">Password</label>
            <span class="material-icons">password</span>
            <input type="password" name="password" id="password" placeholder="Enter your password" required>
        </div>
        <button type="submit">Log In</button>
        <div class="forgot-password">
            <a href="forgotpassword.html">Forgot password?</a>
        </div>
        <div class="signup">
            Don't have an account?<a href="signup.html"> Sign Up</a>
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
