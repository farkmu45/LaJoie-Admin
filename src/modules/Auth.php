<?php

namespace LaJoie\modules;

use LaJoie\models\Admin;
use PDO;
use PDOException;


class Auth
{
    public static function login($username, $password)
    {
        try {
            $stmt = Admin::getByUsername($username);
            if ($stmt->rowCount() == 0) {
                return false;
            }

            $admin = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $admin['password'])) {
                $_SESSION['adminId'] = $admin['id'];
                $_SESSION['adminName'] = $admin['name'];
                $_SESSION['adminUsername'] = $admin['username'];
                $_SESSION['adminType'] = $admin['type'];
                $_SESSION['adminPassword'] = $admin['password'];
                return true;
            }
        } catch (PDOException $e) {
            print_r($e->getMessage());
            die();
        }
    }

    public static function register($name, $username, $password)
    {
        return Admin::create($name, $username, password_hash($password, PASSWORD_BCRYPT));
    }


    public static function guard()
    {
        if (!$_SESSION['adminId']) {
            header('Location: login.php');
            exit();
        }
    }

    public static function logout()
    {
        session_destroy();
    }
}
