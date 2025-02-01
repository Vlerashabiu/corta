<?php
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

session_start();

class Product {
    private $name;
    private $description;
    private $price;
    private $image;

    public function __construct($name, $description, $price, $image) {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->image = $image;
    }

    public function display() {
        return "
            <div class='main1'>
                <img src='{$this->image}' alt=''>
            </div>
            <div class='main2'>
                <h1>{$this->name}</h1>
                <h3>{$this->description}</h3>
                <p>\${$this->price}</p>
            </div>
        ";
    }
}

class User {
    private $username;
    private $password;

    public function __construct($username, $password) {
        $this->username = $username;
        $this->password = $password;
    }

    public function login() {
        if ($this->username == "admin" && $this->password == "admin") {
            $_SESSION['userLoggedIn'] = true;
            return true;
        }
        return false;
    }

    public function logout() {
        session_unset();
        session_destroy();
    }
}

function isUserLoggedIn() {
    return isset($_SESSION['userLoggedIn']) && $_SESSION['userLoggedIn'] === true;
}

$product = new Product("Urban Denim Bag", "100% Organic Cotton Denim", 68.00, "foto2.png");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Major+Mono+Display&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: sans-serif;
        }
        
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: white;
            padding: 10px;
            text-align: center;
            box-shadow: 0px 4px 8px rgba(219, 217, 219, 0.4);
            z-index: 10;
        }
        
        .title {
            font-size: 30px;
            font-family: 'Major Mono Display';
            letter-spacing: 8px;
            cursor: pointer;
            margin-top: 15px;
        }
        
        .navbar a {
            float: left;
            text-decoration: none;
            color: rgb(115,132, 100);
            margin-right: 14px;
            margin-left: 10px;
            font-size: 17px;
        }
        
        a:hover {
            text-decoration: none;
        }
        
        .log-in {
            float: right;
            background-color: #e2d8c8;
            color: white;
            border: none;
            border-radius: 15px;
            padding: 5px 10px;
            cursor: pointer;
            margin-left: 10px;
            margin-right: 10px;
        }
        
        .log-in:hover {
            background-color: #c3b59e;
        }
        
        .sign-up {
            float: right;
            background-color: #e2d8c8;
            color: white;
            border-radius: 15px;
            border: none;
            padding: 5px 10px;
            margin-right: 20px;
            cursor: pointer;
        }
        
        .sign-up:hover {
            background-color: #c3b59e;
        }

        .container {
            display: flex;
            justify-content: space-around;
        }

        .main1 img {
            border: 1px solid #ccc;
            width: 500px;
            height: 600px;
            margin-top: 10rem;
        }

        .main2 {
            margin-top: 10rem;
        }

        .main2 h1 {
            font-size: 55px;
            font-weight: 600;
        }

        .main2 h3 {
            font-size: 30px;
            font-weight: 600;
        }

        .main2 p {
            font-size: 20px;
            font-weight: 600;
            color: gray;
            margin-bottom: 5rem;
            margin-right: 24.2rem;
        }

        #color {
            width: 70%;
            height: 5vh;
            font-size: 1rem;
            padding: 0.5rem;
            border: 3px solid gray;
            margin-top: 10rem;
        }

        .label_color {
            font-size: 1.5rem;
            color: gray;
        }

        .sasia-selector {
            display: flex;
            align-items: center;
            gap: 10px;
            border: 1px solid #ccc;
            position: absolute;
            margin-top: 24rem;
            margin-left: 30rem;
        }

        .sasia-button {
            font-size: 24px;
            width: 40px;
            height: 40px;
            text-align: center;
            line-height: 40px;
            border: 1px solid #ccc;
            cursor: pointer;
            user-select: none;
        }

        .sasia-display {
            font-size: 20px;
            width: 40px;
            text-align: center;
        }

        .button1 {
            font-size: 16px;
            background-color: #000000;
            padding: 14px 36px;
            color: white;
            position: absolute;
            margin-top: 32rem;
            margin-left: 30rem;
            border-radius: 10px;
        }

        .button1:hover {
            cursor: pointer;
            background-color: #c3b59e;
        }

        .container-footer {
            width: 100%;
            height: 10vh;
            margin-top: 0.5rem;
            background-color: gray;
            justify-content: center;
            align-items: center;
            text-align: center;
            display: flex;
        }

        .site-footer {
            position: fixed;
            width: 100%;
            bottom: 0;
            background-color: rgb(202, 216, 190);
            color: rgb(143, 155, 132);
            padding: 9px;
            text-align: center;
            font-size: 10px;
        }
    </style>
</head>

<body>
    <header class="navbar">
        <div class="title">CORTA</div>
        <a href="index.php">Home</a>
        <a href="store.php">Store</a>
        <a href="contact.php">ContactUs</a>
        <a href="news.php">News</a>
        
        <?php if (isUserLoggedIn()): ?>
            <button class="log-in"><a href="logout.php">Logout</a></button>
        <?php else: ?>
            <button class="sign-up"><a href="signup.php">Sign up</a></button>
            <button class="log-in"><a href="login.php">Log in</a></button>
        <?php endif; ?>
    </header>

    <div class="container">
        <?php echo $product->display(); ?>
        
        <div class="sasia-selector">
            <div class="sasia-button" onclick="decrease()">-</div>
            <div class="sasia-display" id="sasia">1</div>
            <div class="sasia-button" onclick="increase()">+</div>
        </div>

        <button class="button1" onclick="addToBag()">Add to bag</button>
    </div>

    <script>
        let sasia = 1;

        function increase() {
            if (sasia < 10) {
                sasia++;
                document.getElementById("sasia").innerText = sasia;
            } else {
                alert("The maximum quantity is 10");
            }
        }

        function decrease() {
            if (sasia > 1) {
                sasia--;
                document.getElementById("sasia").innerText = sasia;
            } else {
                alert("Minimum quantity is 1");
            }
        }

        function addToBag() {
            let userLoggedIn = <?php echo json_encode(isUserLoggedIn()); ?>;

            if (userLoggedIn) {
                alert("Item added to bag with quantity: " + sasia);
            } else {
                loginPrompt();
            }
        }

        function loginPrompt() {
            alert("Please login to continue");
            window.location.href = "login.php";
        }
    </script>

    <footer class="site-footer">
        <div class="footer">
            <p> Copyright © 2024 - 2025 Corta, All Right Reserved.</p>
        </div>
    </footer>

</body>
</html>






