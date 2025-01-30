<?php

class Slide {
    private $image;
    private $title;
    private $date;

    public function __construct($image, $title, $date) {
        $this->image = $image;
        $this->title = $title;
        $this->date = $date;
    }

    public function render() {
        echo '
        <div class="slide fade">
            <img src="' . $this->image . '" alt="' . $this->title . '">
            <div class="text">
                <h3>' . $this->title . '</h3>
                <p>' . $this->date . '</p>
            </div>
        </div>';
    }
}

?>