<?php
session_start();
include 'db.php';
include 'passwordReset.php';

$db = new Database();
$passwordReset = new PasswordReset($db);
$error = "";

if (!isset($_SESSION['reset_email'])) {
    die("Session expired. Please start the reset process again.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_code = implode("", $_POST["code"]);
    $email = $_SESSION['reset_email'];

    $verificationResult = $passwordReset->verifyCode($email, $user_code);

    if ($verificationResult === "valid") {
        header("Location: resetpassword.php");
        exit();
    } else {
        $error = "Incorrect or expired code.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation Code</title>
    <link href="https://fonts.googleapis.com/css2?family=Major+Mono+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="confirmationcode.css">
</head>
<body>
    <header class="navbar">
        <div class ="title">CORTA</div>
           <a href="index.php">Home</a>
           <a href="store.php">Store</a>
           <a href="contact.php">ContactUs</a>
           <a href="news.php">News</a>
          <button class="sign-up"><a href="signup.php">Sign up</a></button>
          <button class="log-in"> <a href="login.php">Log in</a></button>
        </header>


        <div class="cc">
         <h2>Enter Confirmation Code</h2>
         <p>Please enter the code sent to your email</p>
        <form method="POST">
         <div class="confirm">
            <input type="text" maxlength="1" name="code[]" class="code-input" id="code1" autofocus>
            <input type="text" maxlength="1" name="code[]" class="code-input" id="code2">
            <input type="text" maxlength="1" name="code[]" class="code-input" id="code3">
            <input type="text" maxlength="1" name="code[]" class="code-input" id="code4">
            <input type="text" maxlength="1" name="code[]" class="code-input" id="code5">
            <input type="text" maxlength="1" name="code[]" class="code-input" id="code6">
           </div> <br>
         <button type="submit">Verify Code</button>
        </form>
        </div>
    <footer class="site-footer">
        <div class="footer">
       <p> Copyright © 2024 - 2025 Corta, All Right Reserved.</p>
        </div>
           
    </footer>
  

</body>
</html>