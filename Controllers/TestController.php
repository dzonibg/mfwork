<?php

class TestController {

    public function test() {
        return view('test');
    }

    public function testdb() {
        $users = new Users();
        $data = $users->getAll();
        foreach ($data as $user) {
            echo $user->id . $user->name . $user->password . $user->email;
        }
    }

    public function fetch() {
        $users = new Users();
        var_dump($users->fastFinddById(1));
    }

    public function insert() {
        $user = new Users();
        $user->insert("name, password, email", "'Nikola', 'sifra', 'mejl'");
        echo "insert";
    }

    public function create() {
        $user = new Users();
        $user->name = "New Name";
        $user->password = "New Password";
        $user->email = "new@email.com";
        $user->create($user);
    }

    public function request() {
        echo request()->method();
    }

    public function trt() {
        $user = new Users();
        $u = $user->select()->orderBy('id', 'ASC')->getAll();
        var_dump($u);
    }

}