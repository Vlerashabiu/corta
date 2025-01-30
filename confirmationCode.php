<?php
session_start();

if($_SERVER["REQUEST_METHOD"]== "POST"){
    $user_code =implode("",$_POST["code"]);
    if($user_code == $_SESSION['reset_code']){
        header("Location: resetpassword.php");
        exit();
    }else{
        $error= "Invalid confirmation code!";
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
           <a href="home.html">Home</a>
           <a href="store.html">Store</a>
           <a href="contact.html">ContactUs</a>
           <a href="news.html">News</a>
          <button class="sign-up"><a href="signup.html">Sign up</a></button>
          <button class="log-in"> <a href="login.html">Log in</a></button>
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
  
    <script src="forgotpasswordvalidation.js" defer></script>
</body>
</html>
