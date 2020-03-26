<?php

class ErrorHandler {

    public function methodNotFound() {
        echo "404 Framework - Method Not found";
    }

    public function classNotFound() {
        echo "404 Framework - Class not found";
    }

    public function index() {
        echo "500 Whoops. Framework died. Class or method don't exist.";
    }

}