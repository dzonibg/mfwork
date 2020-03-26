<?php

class TestController {

    public function test() {
        echo "Loaded Test Controller, and the method test.";
    }

    public function testdb() {
        $users = new Users();
        $data = $users->index();
        foreach ($data as $user) {
            echo $user->id . $user->name . $user->password . $user->email;
        }
    }
}