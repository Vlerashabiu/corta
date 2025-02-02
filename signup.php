<?php
session_start();
include 'db.php';

class SignupSystem{
    private $conn;

    public function __construct($conn){
        $this->conn=$conn;
    }

    public function registerUser($username,$email,$password){
        $stmt=$this->conn->prepare("SELECT id FROM users WHERE email =?");
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $stmt->store_result();

        if($stmt->num_rows > 0){
            return "Email already exists";
        }

        $hashedPassword= password_hash($password, PASSWORD_DEFAULT);
        $role='user';
        $stmt = $this->conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $email, $hashedPassword, $role);

        if($stmt->execute()){
            return true;
        }else{
            return "Error: Could not register user.";
        }
    }
}
$signupSystem= new SignupSystem($conn);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword=$_POST['confirmPassword'];

    if($password !== $confirmPassword){
        $error="Passwords do not match";
    }else{
        if(!isset($conn)){
            die("Database connection not found");
        }
        $result = $signupSystem->registerUser($username, $email, $password);
        if($result === true){
            header("Location: login.php");
            exit();
        }else{
            $error=$result;
        }
    }
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
           <a href="index.php">Home</a>
           <a href="store.php">Store</a>
           <a href="contact.php">ContactUs</a>
           <a href="news.php">News</a>
          <button class="sign-up"><a href="signup.php">Sign up</a></button>
          <button class="log-in"> <a href="login.php">Log in</a></button>
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
                 Already have an account? <a href="login.php">Log In</a>
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
