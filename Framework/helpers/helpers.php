<?php

function view($viewName, $data = [], $extra = []) {
    extract($data);
    return require_once '../Views/' . $viewName . '.view.php';
}

function redirect($path) {
    header("Location:/" .$path);
}

function layout() {
    if (file_exists("../Views/layout/layout.view.php")) {
        return require_once "../Views/layout/layout.view.php";
    }
}

function dd(...$data) {
    echo "<pre>";

    foreach ($data as $datum) {
        var_dump($datum);
    }

    echo "</pre>";
    die();
}