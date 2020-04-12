<?php

/*
 *  Auth.
 *
 *
 */

class UserController {

    public function register() {
        return view('Auth/register');
    }

    public function create() {
        $user = new User();
        $user->name = request()->post('name');
        $user->password = request()->post('password');
        $user->role = request()->post('role');
        $user->email = request()->post('email');
        $user->create($user);
        return redirect("user/registered");
    }
    

}