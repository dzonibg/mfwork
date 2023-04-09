<?php

namespace Framework;

class Request {

    public function __construct()
    {
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    public function method() {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function get($key) {
      return $_GET[$key];
    }

    public function post($key) {
        return $_POST[$key];
    }

}

//HELPERS:

function request() {
    return new Request();
}