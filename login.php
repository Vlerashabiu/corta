<?php
session_start();
include 'db.php';


class LoginSystem{
    private $conn;

    public function __construct($conn){
        $this->conn =$conn;
    }
    public function loginUser($email, $password){
        $stmt =$this->conn->prepare("SELECT * FROM users WHERE email =?");
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $stmt->store_result();

        if($stmt->num_rows >0){
            $stmt->bind_result($id,$username,$hashed_password,$role,$created_at,$email,$reset_password,$expires_at);
            $stmt->fetch();

            if(password_verify($password, $hashed_password)){
                $_SESSION['id']=$id;
                $_SESSION['username']=$username;
                $_SESSION['email']=$email;
                $_SESSION['role']=$role;

                return $role === 'admin' ? "admin_dashboard.php" : "index.php";

            }
        }
        return false;
    }
}
$loginSystem=new LoginSystem($conn);

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email =$_POST['email'];
    $password =$_POST['password'];

    if(!isset($conn)){
        die("Database connection not found");
    }
    $redirectPage =$loginSystem->loginUser($email, $password);

    if($redirectPage){
        header("Location: $redirectPage");
        exit();
    }else{
        $error= "Invalid email or password.";
    }
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
       <a href="index.php">Home</a>
       <a href="store.php">Store</a>
       <a href="contact.php">ContactUs</a>
       <a href="news.php">News</a>
      </div>
        <button class="sign-up"><a href="signup.php">Sign up</a></button>
        <button class="log-in"> <a href="login.php">Log in</a></button>
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
            <a href="forgotpassword.php">Forgot password?</a>
        </div>
        <div class="signup">
            Don't have an account?<a href="signup.php"> Sign Up</a>
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
