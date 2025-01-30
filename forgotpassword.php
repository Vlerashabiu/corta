<?php
session_start();
$conn = new mysqli("localhost","root","","corta");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email =$_POST['email'];
    $sql ="SELECT * FROM users WHERE email = '$email'";
    $result =$conn->query($sql);

    if($result->num_rows >0){
        $code =rand(100000, 999999);
        $_SESSION['reset_code']=$code;
        $_SESSION['reset_email']= $email;

        echo "Your reset code is: " . $code;
    }else{
        echo "No account ound with this email.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="forgotpasswordstyle.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Major+Mono+Display&display=swap" rel="stylesheet">
   
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

    <div class="forgot-group">
        <h2>Forgot Password</h2>
        <h6>Please enter the email you used for your account</h6>

        <form id="forgotpasswordForm" method="POST">
            <div class="form-group">
                <img src="forgotpic.png" alt="">
                
                <label for="email">Email Address</label>
                <span class="material-icons">email</span>
                <input type="email" name="email" id="email" placeholder="Enter your email" required>
            </div>
           
            <button type="submit">Send Code</button>
        </form>
        <div class="login">
            Return to <a href="login.html">Log In</a>
        </div>
    </div>
   <footer class="site-footer">
        <div class="footer">
       <p> Copyright © 2024 - 2025 Corta, All Right Reserved.</p>
        </div>
           
    </footer>
    <script src="forgotpasswordvalidation.js" defer></script>
</body>
</html>

