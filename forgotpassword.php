<?php



session_start();
include 'db.php';
include 'passwordReset.php';

$db = new Database();
$passwordReset = new passwordReset($db);
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Form submitted!<br>";
    echo "Email: " . $_POST['email'] . "<br>";
    exit(); 
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $email = trim($_POST['email']);

    if (empty($email)) {
        $error = "Please enter an email.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
       
        if (!$passwordReset->checkEmailExists($email)) {
            $error = "No account found with this email.";
        } else {
            $result = $passwordReset->sendResetCode($email);
            if ($result === true) {
                $_SESSION['reset_email'] = $email;
                header("Location: confirmationCode.php");
                exit();
            } else {
                $error = "Error: " . $result;
            }
        }
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
           <a href="index.php">Home</a>
           <a href="store.php">Store</a>
           <a href="contact.php">ContactUs</a>
           <a href="news.php">News</a>
          <button class="sign-up"><a href="signup.php">Sign up</a></button>
          <button class="log-in"> <a href="login.php">Log in</a></button>
    </header>

    <div class="forgot-group">
        <h2>Forgot Password</h2>
        <h6>Please enter the email you used for your account</h6>

        <form id="forgotpasswordForm" method="POST" action="forgotpassword.php">
            <div class="form-group">
                <img src="forgotpic.png" alt="">
                
                <label for="email">Email Address</label>
                <span class="material-icons">email</span>
                <input type="email" name="email" id="email" placeholder="Enter your email" required>
            </div>
           
            <button type="submit">Send Code</button>
            </form>
            <div class="login">
            Return to <a href="login.php">Log In</a>
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
