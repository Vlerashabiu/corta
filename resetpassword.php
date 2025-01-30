<?php
session_start();
$conn =new mysqli("localhost", "root","","corta");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(!isset($_SESSION['reset_email'])){
        echo "Session expired. Please request a new reset link.";
        exit();
    }
    $email=$_SESSION['reset_email'];
    $newPassword=$_POST['newPassword'];
    $confirmPassword= $_POST['confirmPassword'];

    if($newPassword !== $confirmPassword){
        echo "Passwords do not match.";
        exit();
    }
    $hashedPassword =password_hash($newPassword, PASSWORD_DEFAULT);

    $sql = "UPDATE users SET password = ? WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt ->bind_param("ss", $hashedPassword,$email);

    if($stmt->execute()){
        echo "Password has been reset seccessfully!";
        unset($_SESSION['reset_email']);
        header ("Location: login.html");
        exit();
    }else{
        echo "Error resetting password.";
    }
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://fonts.googleapis.com/css2?family=Major+Mono+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="resetPassword.css">
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
         <div class="reset">
          <h2>Reset Password</h2>
         <p>Enter a new password for your account</p>
         <form id="resetPassword" method="POST">
          <label for="newPassword">New Password</label>
          <input type="password" id="newPassword" name="newPassword" required>

          <label for="confirmPassword">Confirm Password</label>
          <input type="password" id="confirmPassword" name="confirmPassword" required> <br>
        
        
          <button type="submit">Reset Password</button>
         </div> 
         </form>
         <footer class="site-footer">
        <div class="footer">
       <p> Copyright © 2024 - 2025 Corta, All Right Reserved.</p>
        </div>
           
    </footer>
    <script src="forgotpasswordvalidation.js" defer></script>
    
    
</body>
</html>