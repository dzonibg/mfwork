<?php

class ErrorHandler {

    public function methodNotFound($controller) {
        echo "404 Framework - Method Not found in controller " . $controller;
    }

    public function classNotFound() {
        echo "404 Framework - Class not found";
    }

    public function index() {
        echo "500 Whoops. Framework died. Class or method don't exist.";
    }

}