<?php

namespace Controllers;

class IndexController {

    public function index() {
        return view('index');
    }

    public function test() {
        $array = ['one', 'two', 'three'];
        return view("test", $array);
    }

}