<?php

class TestController {

    public function test() {
        return view('test');
    }

    public function testdb() {
        $users = new Users();
        $data = $users->index();
        foreach ($data as $user) {
            echo $user->id . $user->name . $user->password . $user->email;
        }
    }

    public function fetch() {
        $users = new Users();
        var_dump($users->fetchAll());
    }
}