<?php
session_start();

class Product {
    private $name;
    private $price;
    private $colors;
    
    public function __construct($name, $price, $colors) {
        $this->name = $name;
        $this->price = $price;
        $this->colors = $colors;
    }

    public function getName() {
        return $this->name;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getColors() {
        return $this->colors;
    }
}

class User {
    private $isLoggedIn;

    public function __construct() {
        $this->isLoggedIn = isset($_SESSION['userLoggedIn']) && $_SESSION['userLoggedIn'] === true;
    }

    public function isLoggedIn() {
        return $this->isLoggedIn;
    }

    public function login() {
        $_SESSION['userLoggedIn'] = true;
    }

    public function logout() {
        session_unset();
        session_destroy();
    }
}

class Cart {
    private $items = [];

    public function addItem($product, $quantity) {
        $this->items[] = ['product' => $product, 'quantity' => $quantity];
    }

    public function getItems() {
        return $this->items;
    }
}

$product = new Product("Canvas Coast Bag", 60.00, ['Olive', 'Midnight', 'Fashion Grey', 'Sand']);
$user = new User();
$cart = new Cart();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($user->isLoggedIn()) {
        $quantity = $_POST['quantity'] ?? 1; 
        $cart->addItem($product, $quantity);
        echo "Item added to bag with quantity: " . $quantity;
    } else {
        echo "<script>alert('Please login to continue');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Major+Mono+Display&display=swap" rel="stylesheet">
    <style>
        *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: sans-serif;
}
        
 .navbar{
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
.title{
   font-size: 30px;
   font-family: 'Major Mono Display';
   letter-spacing: 8px;
   cursor: pointer;
   margin-top: 15px;
}
.navbar a{
    float: left;
    text-decoration: none;
    color: rgb(115,132, 100);
    margin-right: 14px;
    margin-left: 10px;
    font-size: 17px;
   
}
a:hover{
    text-decoration: none;
}

.log-in{
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
.log-in:hover{
    background-color: #c3b59e;
}
.sign-up{
    float: right;
    background-color: #e2d8c8;
    color: white;
    border-radius: 15px;
    border: none;
    padding: 5px 10px;
    margin-right: 20px;
    cursor: pointer;
}
.sign-up:hover{
    background-color: #c3b59e;
}

        .contanier {
            display: flex;
            
            justify-content: space-around;
        }


        .main1 img {
            border: 1px solid #ccc;
            width: 500px;
            height: 600px;
            margin-top: 10rem;
        }
.main2{
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
            margin-top: 33.5rem;
            margin-left: 29.3rem;
            

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
            margin-top: 40rem;
            margin-left: 29.3rem;
            border-radius: 10px;
        }
        .button1:hover{
            cursor: pointer;
            background-color: #c3b59e;
        }
        
        .container-footer{
    width: 100%;
    height: 10vh;
    margin-top: 0.5rem;
    background-color: gray;
    justify-content: center;
    align-items: center;
    text-align: center;
    display: flex;
 
}
.site-footer{
    position:fixed;
    width: 100%;
    bottom: 0;
    background-color: rgb(202, 216, 190); 
    color: rgb(143, 155, 132); 
    padding:9px; 
    text-align: center; 
    font-size: 10px; 
}
    </style>
</head>
<body>
    <header class="navbar">
        <div class="title">CORTA</div>
        <a href="home.php">Home</a>
        <a href="store.php">Store</a>
        <a href="contact.php">ContactUs</a>
        <a href="news.php">News</a>
        <?php if ($user->isLoggedIn()): ?>
            <button class="sign-up"><a href="logout.php">Log out</a></button>
        <?php else: ?>
            <button class="sign-up"><a href="login.php">Log in</a></button>
        <?php endif; ?>
    </header>

    <div class="container">
        <div class="main1">
            <img src="foto4.png" alt="Product Image">
        </div>
        <div class="main2">
            <h1><?php echo $product->getName(); ?></h1>
            <h3>100% Organic Cotton Canvas</h3>
            <p>$<?php echo $product->getPrice(); ?></p>
            <label for="color" class="label_color">Color</label>
            <br>
            <select name="color" id="color">
                <?php foreach ($product->getColors() as $color): ?>
                    <option value="<?php echo $color; ?>"><?php echo $color; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <form method="POST" action="">
            <div class="sasia-selector">
                <div class="sasia-button" onclick="decrease()">-</div>
                <div class="sasia-display" id="sasia">1</div>
                <div class="sasia-button" onclick="increase()">+</div>
            </div>
            <input type="hidden" name="quantity" id="quantity" value="1">
            <button class="button1" type="submit">Add to bag</button>
        </form>
    </div>

    <footer class="site-footer">
        <div class="footer">
            <p> Copyright © 2024 - 2025 Corta, All Right Reserved.</p>
        </div>
    </footer>

    <script>
        let quantity = 1; 

        function increase() {
            if (quantity < 10) {
                quantity++; 
                document.getElementById("sasia").innerText = quantity; 
                document.getElementById("quantity").value = quantity;
            } else {
                alert("The maximum quantity is 10");
            }
        }

        function decrease() {
            if (quantity > 1) {
                quantity--; 
                document.getElementById("sasia").innerText = quantity; 
                document.getElementById("quantity").value = quantity;
            } else {
                alert("Minimum quantity is 1");
            }
        }
    </script>
</body>
</html>



