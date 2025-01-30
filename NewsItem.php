<?php

class NewsItem {
    private $link;
    private $image;
    private $title;
    private $date;

    public function __construct($link, $image, $title, $date) {
        $this->link = $link;
        $this->image = $image;
        $this->title = $title;
        $this->date = $date;
    }

    public function render() {
        echo '
        <div class="image-box">
            <a href="' . $this->link . '">
                <img src="' . $this->image . '" alt="' . $this->title . '">
            </a>
            <h5>' . $this->title . '</h5>
            <p>' . $this->date . '</p>
        </div>';
    }
}
?>