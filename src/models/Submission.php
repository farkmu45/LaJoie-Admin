<?php

namespace LaJoie\models;

use LaJoie\modules\Model;
use PDO;
use PDOException;

class Submission extends Model
{
    public static function getAll()
    {
        try {
            $query = "SELECT submissions.*, CONVERT_TZ(submissions.created_at, '+00:00','+7:00') AS created_at_gmt, users.username 
            FROM submissions INNER JOIN users ON users.id = submissions.user_id
            ORDER BY created_at DESC";
            $stmt = self::prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print_r($e->getMessage());
            die();
        }
    }

    public static function get($id)
    {
        try {
            $query = "SELECT submissions.*, CONVERT_TZ(submissions.created_at, '+00:00','+7:00') AS created_at_gmt, users.username, users.name, users.picture 
            FROM submissions INNER JOIN users ON users.id = submissions.user_id
            WHERE submissions.user_id=:id
            ORDER BY created_at DESC";
            $stmt = self::prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            if ($stmt->rowCount() == 0) {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print_r($e->getMessage());
            die();
        }
    }

    public static function acceptSubmission($userId)
    {
        try {
            $query = "UPDATE submissions SET is_checked = true WHERE user_id=:userId";
            $stmt = self::prepare($query);
            $stmt->bindParam('userId', $userId);
            $stmt->execute();
            return self::changeUserStatus($userId, 2);
        } catch (PDOException $e) {
            print_r($e->getMessage());
            die();
        }
    }

    public static function rejectSubmission($userId) {
        try {
            $query = "DELETE FROM submissions WHERE user_id=:userId";
            $stmt = self::prepare($query);
            $stmt->bindParam('userId', $userId);
            $stmt->execute();
            return self::changeUserStatus($userId, 1);
        } catch (PDOException $e) {
            print_r($e->getMessage());
            die();
        }
    }

    private static function changeUserStatus($userId, $status)
    {
        try {
            $query = "UPDATE users SET status = 'ACTIVE', user_type_id=$status WHERE id=:id";
            $stmt = self::prepare($query);
            $stmt->bindParam('id', $userId);
            return $stmt->execute();
        } catch (PDOException $e) {
            print_r($e->getMessage());
            die();
        }
    }

    public static function count()
    {
        try {
            $query = "SELECT count(user_id) AS count FROM submissions";
            $stmt = self::prepare($query);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print_r($e->getMessage());
            die();
        }
    }
}
