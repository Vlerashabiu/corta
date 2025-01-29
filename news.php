<?php
include 'layout.php'; 

renderHeader("News - Corta");
?>

<h1>Latest News</h1>
<p>Stay updated with the latest news and offers from Corta.</p>

<div class="news">
    <div class="news-item">
        <a href="news1.php">
            <img src="foto10.jpg" alt="New Organic Products Launched">
            <h4>New Organic Products Launched</h4>
            <p>January 12, 2025</p>
        </a>
    </div>
    <div class="news-item">
        <a href="news2.php">
            <img src="foto11.jpg" alt="Discount for First Orders">
            <h4>Discount for First Orders</h4>
            <p>January 10, 2025</p>
        </a>
    </div>
    <div class="news-item">
        <a href="news3.php">
            <img src="foto13.jpg" alt="About Us">
            <h4>About Us</h4>
            <p>January 8, 2025</p>
        </a>
    </div>
</div>

<?php
renderFooter();
?>
