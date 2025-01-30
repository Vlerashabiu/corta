
<?php
include 'db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = validateInput($_POST['name']);
    $email = validateInput($_POST['email']);
    $message = validateInput($_POST['message']);

    if (empty($name) || empty($email) || empty($message)) {
        echo "All fields are required!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address!";
    } else {
        $stmt = $conn->prepare("INSERT INTO messages (name, email, message, created_at) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("sss", $name, $email, $message);

        if ($stmt->execute()) {
            echo "Your message has been successfully sent!";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}

function validateInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
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
        <div class="title">CORTA</div>
        <a href="home.php">Home</a>
        <a href="store.php">Store</a>
        <a href="contact.php">ContactUs</a>
        <a href="news.php">News</a>
        <button class="sign-up"><a href="signup.php">Sign up</a></button>
        <button class="log-in"><a href="login.php">Log in</a></button>
    </header>

    <p class="info">Reach out to us for any questions or information.</p>

    <div class="main">
        <form id="form" action="contact.php" method="POST">
            <div class="form">
                <label for="name">Name:</label><br>
                <input type="text" id="name" name="name" placeholder="Your name" required><br><br>

                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email" placeholder="Your email" required><br><br>

                <label for="message">Message:</label>
                <textarea id="message" name="message" placeholder="Enter your message" rows="4" cols="50" maxlength="200" required></textarea>
                <br><br>

                <button type="submit" class="submit">Submit</button>
            </div>
        </form>
        <div class="contact-info">
            <p><strong>Email:</strong> support@corta.com</p>
            <p><strong>Phone:</strong> +383 44 000 000</p>

            <div class="button-container">
                <a href="terms.php" class="terms">Terms and Conditions</a>
                <a href="privacy.php" class="privacy">Privacy Policy</a>
                <a href="refund.php" class="refund">Refund Policy</a>
            </div>
        </div>
    </div>

    <footer class="site-footer">
        <div class="footer">
            <p>Copyright © 2024 - 2025 Corta, All Right Reserved.</p>
        </div>
    </footer>
    <script src="contact.js"></script>
</body>
</html>