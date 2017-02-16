<?php

namespace framework\core;

use common\models\User;

class Auth {
    
    /**
     * 
     * @return boolean
     */
    public static function isAuth() {
        if (isset($_SESSION["login"])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 
     * @param string $login
     * @param string $passwors
     * @return boolean
     */
    public static function auth($login, $password, $type = 1) {
        $user = new User();        
        if ($user->check($login, $password, $type)) {
            $_SESSION["login"] = $login;
            return true;
        } else {
            return false;
        }
    }

    /**
     * 
     * @return mixed
     */
    public static function getUser() {
        if (self::isAuth()) {
            return $_SESSION["login"];
        } else {
            return false;
        }
    }

    public static function logout() {
        unset($_SESSION["login"]);
    }

}