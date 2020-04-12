<?php


class Auth {
    public function check() {
        if (isset($_SESSION['auth']) && ($_SESSION['auth'] == true)) {
            return true;
        } else return false;
    }

    public function login($username) {
        $_SESSION['auth'] = true;
        $_SESSION['username'] = $username;
    }

    public function logout() {
        session_destroy();
        return true;
    }

    public function roleCheck($role) {
        if ($_SESSION['role'] == $role) {
            return true;
        } else return false;
    }

}