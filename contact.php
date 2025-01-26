<?php
session_start();

$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to CORTA</title>
    <link rel="stylesheet" href="contact.css">
    <link href="https://fonts.googleapis.com/css2?family=Major+Mono+Display&display=swap" rel="stylesheet">
</head>
<body>
    <header class="navbar">
        <div class ="title">CORTA</div>
           <a href="home.html">Home</a>
           <a href="store.html">Store</a>
           <a href="contact.html">ContactUs</a>
           <a href="news.html">News</a>
          <button class="sign-up"> <a href="signup.html">Sign up</a></button>
          <button class="log-in"> <a href="login.html">Log in</a></button>
    </header>

         <p class="info">Reach out to us for any questions or information.</p>
   
    <div class = "main">
      <form id="form">
        <div class="form">
        <?php if (!$isLoggedIn): ?>
                    <label for="name">Name:</label><br>
                    <input type="text" id="name" placeholder="Your name" required><br><br>
                    <label for="email">Email:</label><br>
                    <input type="email" id="email" placeholder="Your email" required><br><br>
                <?php else: ?>
                    <input type="hidden" id="name" value="<?php echo $username; ?>">
                    <input type="hidden" id="email" value="<?php echo $email; ?>">
                <?php endif; ?>
          <label for="message">Message:</label>
          <textarea id="message" name="message" placeholder="Enter your message" rows="4" cols="50" maxlength="200" required></textarea>
         <br><br>
    
         <button type="submit" class="submit">Submit</button>
        </div>
      </form> 

      <div class="contact-info">
        <p><strong>Email:</strong> support@corta.com</p>
        <p><strong>Phone:</strong> +383 44 000 000</p>
  
    <div class ="button-container">
    <a href="terms.html" class="terms">Terms and Conditions</a>
    <a href="privacy.html" class="privacy">Privacy Policy</a>
    <a href="refund.html" class="refund">Refund Policy</a>
    </div>
  </div>
</div>
 
   <footer class="site-footer">
        <div class="footer">
       <p> Copyright © 2024 - 2025 Corta, All Right Reserved.</p>
        </div>        
    </footer>

    <script src="contact.js"></script>

</body>
</html>