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

        .log-in, .sign-up {
            float: right;
            background-color: #e2d8c8;
            color: white;
            border: none;
            border-radius: 15px;
            padding: 5px 10px;
            cursor: pointer;
            margin-right: 20px;
        }

        .log-in:hover, .sign-up:hover {
            background-color: #c3b59e;
        }

        .slider {
            position: relative;
            width: 100%;
            height: 360px;
            overflow: hidden;
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
            height: 100%;
            object-fit: cover;
        }

        .text {
            position: absolute;
            bottom: 20px;
            left: 20px;
            color: white;
            background-color: rgba(122, 126, 155, 0.5);
            padding: 10px;
            border-radius: 20px;
        }

        .image {
            display: flex;
            justify-content: space-around;
            margin-top: 5rem;
            text-align: center;
        }

        .image img {
            width: 350px;
            height: 370px;
            border: 2px solid #ccc;
            border-radius: 30px;
        }

        .site-footer {
            position: absolute;
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

    <div class="slider">
        <?php
        $slides = [
            ["materials.jpg", "New Organic Products Launched", "January 12, 2025"],
            ["aboutus.jpg", "Discount for First Orders", "January 12, 2025"],
            ["newProducts.jpg", "About Us", "January 8, 2025"]
        ];

        foreach ($slides as $slide) {
            echo '
            <div class="slide fade">
                <img src="' . $slide[0] . '" alt="' . $slide[1] . '">
                <div class="text">
                    <h3>' . $slide[1] . '</h3>
                    <p>' . $slide[2] . '</p>
                </div>
            </div>';
        }
        ?>
    </div>

    <div class="image">
        <?php
        $news = [
            ["news1.html", "materials.jpg", "New Organic Products Launched", "January 12, 2025"],
            ["news3.html", "aboutus.jpg", "About Us", "January 8, 2025"],
            ["news2.html", "newProducts.jpg", "Discount for First Orders", "January 10, 2025"]
        ];

        foreach ($news as $item) {
            echo '
            <div class="image-box">
                <a href="' . $item[0] . '">
                    <img src="' . $item[1] . '" alt="' . $item[2] . '">
                </a>
                <h5>' . $item[2] . '</h5>
                <p>' . $item[3] . '</p>
            </div>';
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
