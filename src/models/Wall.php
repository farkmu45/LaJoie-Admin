<?php

namespace LaJoie\models;

use PDO;
use PDOException;
use LaJoie\modules\Model;

class Wall extends Model
{
    public static function getAll()
    {
        try {
            $query = "SELECT questions.*, CONVERT_TZ(questions.created_at, '+00:00','+7:00') AS created_at_gmt, users.username 
            FROM questions INNER JOIN users ON users.id = questions.user_id
            ORDER BY created_at DESC";
            $stmt = self::prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print_r($e->getMessage());
            die();
        }
    }

    public static function getById($id)
    {
        try {
            $query = "SELECT questions.*, CONVERT_TZ(questions.created_at, '+00:00','+7:00') AS created_at_gmt, users.username, users.picture 
            FROM questions INNER JOIN users ON users.id = questions.user_id WHERE questions.id = :id";
            $stmt = self::prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print_r($e->getMessage());
            die();
        }
    }

    public static function changeStatus($id, $status)
    {
        try {
            $query = "UPDATE questions SET status=:status WHERE id=:id";
            $stmt = self::prepare($query);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            print_r($e->getMessage());
            die();
        }
    }

    public static function count()
    {
        try {
            $query = "SELECT count(id) AS count FROM questions";
            $stmt = self::prepare($query);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print_r($e->getMessage());
            die();
        }
    }
}
