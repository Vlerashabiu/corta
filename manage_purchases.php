<?php
// Kontrolloni nëse është dërguar kërkesa POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Merrni të dhënat e shportës nga forma
    $cartItems = json_decode($_POST['cartItems'], true);

    // Kontrolloni nëse ka artikuj në shportë
    if (!empty($cartItems)) {
        // Krijoni lidhjen me bazën e të dhënave (shtoni kredencialet e duhur)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "corta_store";  // Emri i bazës suaj të të dhënave

        // Krijoni lidhjen
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Kontrolloni nëse lidhja ka pasur gabime
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Ruani çdo artikull të shportës në bazën e të dhënave
        foreach ($cartItems as $item) {
            $product_name = $conn->real_escape_string($item['product_name']);
            $price = $conn->real_escape_string($item['price']);
            $quantity = $conn->real_escape_string($item['quantity']);

            // Krijoni kërkesën SQL për të ruajtur artikujt në tabelën e blerjeve
            $sql = "INSERT INTO purchases (product_name, price, quantity) VALUES ('$product_name', '$price', '$quantity')";

            if ($conn->query($sql) === TRUE) {
                echo "Product added: " . $product_name . "<br>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        // Mbyllni lidhjen me bazën e të dhënave
        $conn->close();
    } else {
        echo "Your cart is empty.";
    }
} else {
    // Nëse kërkesa nuk është POST, drejtojeni përdoruesin diku tjetër
    echo "Invalid request.";
}
?>
