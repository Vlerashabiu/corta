<?php
// Përfshijmë klasat që kemi krijuar
include 'Slide.php';
include 'NewsItem.php';

// Instancimi i slides dhe lajmeve
$slides = [
    new Slide("materials.jpg", "New Organic Products Launched", "January 12, 2025"),
    new Slide("aboutus.jpg", "Discount for First Orders", "January 12, 2025"),
    new Slide("newProducts.jpg", "About Us", "January 8, 2025")
];

$news = [
    new NewsItem("news1.html", "materials.jpg", "New Organic Products Launched", "January 12, 2025"),
    new NewsItem("news3.html", "aboutus.jpg", "About Us", "January 8, 2025"),
    new NewsItem("news2.html", "newProducts.jpg", "Discount for First Orders", "January 10, 2025")
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News - CORTA</title>
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
            color: rgb(115, 132, 100);
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
            margin-right: 20px;
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

        .slider {
            position:relative;
            width: 100%;
            height:360px; 
            overflow: hidden;
            transform: translateX();
            margin-top: 20px;
        }

        .slide {
            display: none;
            position: absolute;
            width: 100%;
            height: 100%;
        }

        .slide img {
            width: 100%;
            object-fit:cover;
            height: 100%;
            
        }

        .text {
            position: absolute;
            bottom: 20px;
            left: 20px;
            color: #f5ecec;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            font-size: 10px;
            background-color: rgba(122, 126, 155, 0.5);
            padding: 10px;
            border-radius: 20px;
            height: auto;
        }

        .text h3 {
            margin: 0;
            font-size: 15px;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            
        }

        .text p {
            margin: 0;
            font-size: 12px;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
           
        }

        @media (max-width: 768px) {
    .navbar a {
        font-size: 14px;
        margin-right: 10px;
    }

    .navbar .title {
        font-size: 25px;
        letter-spacing: 5px;
    }

    .log-in, .sign-up {
        padding: 4px 8px;
        font-size: 14px;
    }

    .slider {
        height: 250px;
    }

    .text h3 {
        font-size: 14px;
    }

    .text p {
        font-size: 10px;
    }

    .image {
        flex-direction: column;
        align-items: center;
        margin-top: 3rem;
    }

    .image img {
        width: 100%;
        height: auto;
        margin-bottom: 20px;
    }

    .image h5 {
        font-size: 18px;
    }

    .image p {
        font-size: 12px;
    }
}

@media (max-width: 480px) {
    .navbar {
        padding: 8px;
    }

    .navbar a {
        font-size: 12px;
        margin-right: 8px;
    }

    .title {
        font-size: 20px;
    }

    .log-in, .sign-up {
        padding: 3px 6px;
        font-size: 12px;
    }

    .slider {
        height: 200px;
    }

    .text h3 {
        font-size: 12px;
    }

    .text p {
        font-size: 8px;
    }

    .image img {
        width: 90%;
        height: auto;
    }

    .image h5 {
        font-size: 16px;
    }

    .image p {
        font-size: 10px;
    }
}

.site-footer {
    position: relative;
    width: 100%;
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
        <a href="home.html">Home</a>
        <a href="store.html">Store</a>
        <a href="contact.html">Contact Us</a>
        <a href="news.html">News</a>
        <button class="sign-up"><a href="signup.html">Sign up</a></button>
        <button class="log-in"><a href="login.html">Log in</a></button>
    </header>

    <!-- Slider -->
    <div class="slider">
        <?php
        foreach ($slides as $slide) {
            $slide->render();  // Thirr funksionin për të shfaqur çdo slide
        }
        ?>
    </div>

    <!-- News Items -->
    <div class="image">
        <?php
        foreach ($news as $item) {
            $item->render();  // Thirr funksionin për të shfaqur çdo artikull lajmi
        }
        ?>
    </div>

    <footer class="site-footer">
        <p>Copyright © 2024 - 2025 CORTA, All Rights Reserved.</p>
    </footer>

    <script>
        let slideIndex = 0;
        function showSlides() {
            let slides = document.getElementsByClassName("slide");
            for (let i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";  
            }
            slideIndex++;
            if (slideIndex > slides.length) {
                slideIndex = 1;
            }  
            slides[slideIndex - 1].style.display = "block";  
            setTimeout(showSlides, 3000); 
        }
        showSlides();
    </script>

</body>

</html>

