<?php


class Bootstrap {

    public function title($title) {
        echo "\r\n<title>{$title}</title>\r\n";
    }

    public function alert($text, $type) {
        echo "\r\n<div class='alert alert-{$type}' role='alert'>";
        echo "\r\n{$text}";
        echo "\r\n</div>";
    }

}