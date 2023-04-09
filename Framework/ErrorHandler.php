<?php

namespace Framework;

class ErrorHandler {

    public function methodNotFound($data) {
        echo "404 Framework - Method  $data[2]  not found in controller " . $data[1];
    }

    public function classNotFound() {
        echo "404 Framework - Class not found";
    }

    public function index() {
        echo "500 Whoops. Framework died. Class or method don't exist.";
    }

}