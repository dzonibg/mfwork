<?php

function view($viewName, $data = [], $extra = []) {
    extract($data);
    return require_once '../Views/' . $viewName . '.view.php';
}

function redirect($path) {
    header("Location:/" .$path);
}

function loadBootstrap() {
    echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
';
    echo '<link rel="stylesheet" href="/resources/main.css">';
}

function layout() {
    if (file_exists("../Views/layout/layout.view.php")) {
        return require_once "../Views/layout/layout.view.php";
    }
}

function br() {
    echo "<br>";
}

function get_public_properties($object) {
    return get_object_vars($object);
}

function bootstrap() {
    return new Bootstrap();
}

function bs() {
    return new Bootstrap();
}

function auth() {
    return new Auth();
}