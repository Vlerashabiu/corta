<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cartItems = json_decode($_POST['cartItems'], true);

    if (!empty($cartItems)) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "corta_store"; 

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        foreach ($cartItems as $item) {
            $product_name = $conn->real_escape_string($item['product_name']);
            $price = $conn->real_escape_string($item['price']);
            $quantity = $conn->real_escape_string($item['quantity']);

            $sql = "INSERT INTO purchases (product_name, price, quantity) VALUES ('$product_name', '$price', '$quantity')";

            if ($conn->query($sql) === TRUE) {
                echo "Product added: " . $product_name . "<br>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        $conn->close();
    } else {
        echo "Your cart is empty.";
    }
} else {
    echo "Invalid request.";
}
?>
