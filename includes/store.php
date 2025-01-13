<?php
include 'layout.php'; 

renderHeader("Store - Corta");
?>

<h1>Our Boutique</h1>
<p>Explore our collection of bags, shoes, and accessories.</p>

<div class="products">
    <div class="product">
        <a href="image1.php">
            <img src="foto1.png" alt="Chic Corduroy Bag">
            <h4>Chic Corduroy Bag</h4>
            <p>$65.00</p>
        </a>
    </div>
    <div class="product">
        <a href="image2.php">
            <img src="foto2.png" alt="Urban Denim">
            <h4>Urban Denim</h4>
            <p>$68.00</p>
        </a>
    </div>
</div>

<?php
renderFooter();
?>
