<?php
// Klasa Navbar për menunë e lartë
class Navbar {
    public function render() {
        echo '
        <header class="navbar">
            <div class="title">CORTA</div>
            <a href="home.php">Home</a>
            <a href="store.php">Store</a>
            <a href="contact.php">ContactUs</a>
            <a href="news.php">News</a>
            <button class="sign-up"> <a href="signup.php">Sign up</a> </button>
            <button class="log-in"> <a href="login.php">Log in</a></button>
        </header>';
    }
}

// Klasa Cart për funksionet e lidhura me çantën
class Cart {
    private $quantity = 1;

    public function increaseQuantity() {
        if ($this->quantity < 10) {
            $this->quantity++;
        } else {
            echo "<script>alert('The maximum quantity is 10');</script>";
        }
    }

    public function decreaseQuantity() {
        if ($this->quantity > 1) {
            $this->quantity--;
        } else {
            echo "<script>alert('Minimum quantity is 1');</script>";
        }
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function addToBag() {
        $userLoggedIn = isset($_SESSION['userLoggedIn']) ? $_SESSION['userLoggedIn'] : false;

        if ($userLoggedIn) {
            echo "<script>alert('Item added to bag with quantity: " . $this->getQuantity() . "');</script>";
        } else {
            $this->loginPrompt();
        }
    }

    private function loginPrompt() {
        echo "<script>alert('Please login to continue'); window.location.href = 'login.php';</script>";
    }
}

session_start(); // Përdorimi i sesionit për menaxhimin e gjendjes së login
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chic Corduroy Bag</title>
    <link rel="stylesheet" href="style.css"> <!-- Lidhja me skedarin CSS -->
</head>

<body>
<?php
    $navbar = new Navbar(); // Krijimi i objektit Navbar
    $navbar->render(); // Thirrja e metodës render për të shfaqur menunë
?>

<div class="contanier">
    <div class="main1">
        <img src="foto1.png" alt="Chic Corduroy Bag">
    </div>
    <div class="main2">
        <h1>Chic Corduroy <br>Bag</h1>
        <h3>00% Organic Cotton Corduroy</h3>
        <p>$65.00</p>
        <label for="color" class="label_color">Color</label>
        <br>
        <select name="color" id="color">
            <option value="Olive">Olive</option>
            <option value="Midnight">Midnight</option>
            <option value="Fashion Grey">Fashion Grey</option>
            <option value="Sand">Sand</option>
        </select>
    </div>

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
        sasia++;
        document.getElementById("sasia").innerText = sasia;
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
        let userLoggedIn = localStorage.getItem('userLoggedIn');

        if (userLoggedIn === "true") {
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
