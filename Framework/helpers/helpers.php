<?php

function view($viewName, $data = [], $extra = []) {
    extract($data);
    return require_once '../Views/' . $viewName . '.view.php';
}

function redirect($path) {
    header("Location:/" .$path);
}