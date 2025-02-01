<?php
include_once 'Product.php';
include_once 'User.php';

$product = new Product("Chic Corduroy Bag", "100% Organic Cotton Corduroy", 65.00, "foto1.png");
$user = new User();

// Check if the user is logged in
$isUserLoggedIn = $user->isLoggedIn();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        <a href="home.html">Home</a>
        <a href="store.html">Store</a>
        <a href="contact.html">ContactUs</a>
        <a href="news.html">News</a>
        <button class="sign-up"> <a href="signup.php">Sign up</a> </button>
        <?php if ($isUserLoggedIn): ?>
            <button class="log-in"> <a href="logout.php">Log out</a></button>
        <?php else: ?>
            <button class="log-in"> <a href="login.php">Log in</a></button>
        <?php endif; ?>
    </header>

    <div class="contanier">
        <div class="main1">
            <img src="<?php echo $product->getImage(); ?>" alt="">
        </div>
        <div class="main2">
            <h1><?php echo $product->getName(); ?></h1>
            <h3><?php echo $product->getDescription(); ?></h3>
            <p>$<?php echo number_format($product->getPrice(), 2); ?></p>
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
            if (<?php echo $isUserLoggedIn ? 'true' : 'false'; ?>) {
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

