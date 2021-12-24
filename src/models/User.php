<?php
namespace LaJoie\models;

use LaJoie\modules\Model;
use PDO;
use PDOException;

class User extends Model
{
    public static function getAllUser()
    {
        try {
            $query = "SELECT users.*, user_types.name AS type FROM users INNER JOIN user_types ON users.user_type_id = user_types.id";
            $stmt = self::prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print_r($e->getMessage());
            die();
        }
    }

    public static function create($name, $username, $email, $password)
    {
        try {
            $query = "INSERT INTO users(name, username, email, password) VALUES(:name, :username, :email, :password)";
            $stmt = self::prepare($query);
            $stmt->bindParam('name', $name);
            $stmt->bindParam('username', $username);
            $stmt->bindParam('email', $email);
            $stmt->bindParam('password', $password);
            $stmt->execute();
        } catch (PDOException $e) {
            die();
        }
    }

    public static function changeStatus($userId, $status)
    {
        try {
            $query = "UPDATE users SET status=:status WHERE id=:userId";
            $stmt = self::prepare($query);
            $stmt->bindParam('userId', $userId);
            $stmt->bindParam('status', $status);
            return $stmt->execute();
        } catch (PDOException $e) {
            print_r($e->getMessage());
            die();
        }
    }
}
