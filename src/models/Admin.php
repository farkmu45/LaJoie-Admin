<?php

namespace LaJoie\models;

use LaJoie\modules\Model;
use PDO;
use PDOException;


class Admin extends Model
{
    public static function getByUsername($username)
    {
        try {
            $query = "SELECT * FROM admins WHERE username=:username";
            $stmt = self::prepare($query);
            $stmt->bindParam('username', $username);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            print_r($e->getMessage());
            die();
        }
    }


    public static function create($name, $username, $password)
    {
        try {
            $query = "INSERT INTO admins(name, username, password) VALUES(:name, :username, :password)";
            $stmt = self::prepare($query);
            $stmt->bindParam('name', $name);
            $stmt->bindParam('username', $username);
            $stmt->bindParam('password', $password);
            return $stmt->execute();
        } catch (PDOException $e) {
            print_r($e->getMessage());
            die();
        }
    }

    public static function update($id, $name, $username, $password)
    {
        try {
            $query = "UPDATE admins SET name=:name, username=:username, password=:password WHERE id=:id";
            $stmt = self::prepare($query);
            $stmt->bindParam('id', $id);
            $stmt->bindParam('name', $name);
            $stmt->bindParam('username', $username);
            $stmt->bindParam('password', $password);
            return $stmt->execute();
        } catch (PDOException $e) {
            print_r($e->getMessage());
            die();
        }
    }

    public static function getAll()
    {
        try {
            $query = "SELECT * FROM admins WHERE type=1";
            $stmt = self::prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print_r($e->getMessage());
            die();
        }
    }

    public static function count()
    {
        try {
            $query = "SELECT count(id) AS count FROM admins WHERE type=1";
            $stmt = self::prepare($query);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print_r($e->getMessage());
            die();
        }
    }

    public static function get($id)
    {
        try {
            $query = "SELECT * FROM admins WHERE id=:id";
            $stmt = self::prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print_r($e->getMessage());
            die();
        }
    }


    public static function delete($id)
    {
        try {
            $query = "DELETE FROM admins WHERE id=:id AND type != 2";
            $stmt = self::prepare($query);
            $stmt->bindParam('id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            print_r($e->getMessage());
            die();
        }
    }
}
