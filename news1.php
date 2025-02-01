<?php
class Page {
    private $title;
    private $header;
    private $footer;
    
    public function __construct($title = "Document") {
        $this->title = $title;
        $this->header = new Header();
        $this->footer = new Footer();
    }

    public function renderHeader() {
        $this->header->render();
    }

    public function renderFooter() {
        $this->footer->render();
    }

    public function renderContent() {
        echo '
        <div class="text">
            <h3>The newest products</h3>
            <br>
            <h5>We are pleased to introduce our newest bag, designed for those looking for a perfect combination between fashion and functionality.</h5><br><br>
            <h5>Premium materials, durable stitching and clever compartments make this bag not only beautiful, but also practical. Choose elegance and comfort - choose our new bag. Don\'t miss this fantastic opportunity to get started with style and savings!</h5><br>
            <h5>Be part of the trend and refresh your style with an irreplaceable accessory!</h5>
        </div>';
    }

    public function render() {
        echo '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>' . $this->title . '</title>
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
                font-family: \'Major Mono Display\';
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
            h1 {
                text-align: center;
                margin-top: 13rem;
                font-size: 4rem;
                font-family: sans-serif;
                font-weight: 400;
            }
            body {
                background-image: url(\'foto14.jpg\');
                background-size: 100%;
                background-position: center;
                color: black;
                text-align: center;
                height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
                width: 100%;
            }
            .text h3 {
                font-family: \'Gill Sans\', \'Gill Sans MT\', Calibri, \'Trebuchet MS\', sans-serif;
                color: rgb(112, 95, 73);
                margin-top: 4rem;
            }
            .text h5 {
                font-family: \'Gill Sans\', \'Gill Sans MT\', Calibri, \'Trebuchet MS\', sans-serif;
                font-weight: bold;
                color: rgb(104, 85, 61);
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
        <body>';
        
        $this->renderHeader();
        $this->renderContent();
        $this->renderFooter();
        
        echo '</body></html>';
    }
}

class Header {
    public function render() {
        echo '<header class="navbar">
                <div class="title">CORTA</div>
                <a href="home.php">Home</a>
                <a href="store.php">Store</a>
                <a href="contact.php">ContactUs</a>
                <a href="news.php">News</a>
                <button class="sign-up"><a href="signup.php">Sign up</a></button>
                <button class="log-in"><a href="login.php">Log in</a></button>
              </header>';
    }
}

class Footer {
    public function render() {
        echo '<footer class="site-footer">
                <p>Copyright © 2024 - 2025 CORTA, All Rights Reserved.</p>
              </footer>';
    }
}

$page = new Page("News - CORTA");
$page->render();
?>
