<?php

namespace LaJoie\models;

use LaJoie\modules\Model;
use LaJoie\modules\Response;
use PDO;
use PDOException;

class Knowledge extends Model
{
    public static function getAll()
    {
        try {
            $query = "SELECT * FROM knowledges";
            $stmt = self::prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print_r($e->getMessage());
            die();
        }
    }

    public static function getKnowledgeById($id)
    {
        try {
            $query = "SELECT knowledge_details.id, knowledges.id AS category_id, knowledge_details.name AS name, knowledge_details.text, knowledges.name AS category 
            FROM knowledge_details 
            INNER JOIN knowledges ON knowledges.id=knowledge_details.knowledge_id WHERE knowledge_details.id=:id";
            $stmt = self::prepare($query);
            $stmt->bindParam('id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print_r($e->getMessage());
            die();
        }
    }

    public static function getDetail($id)
    {
        try {
            $query = "SELECT * FROM knowledge_details WHERE knowledge_id = :id";
            $stmt = self::prepare($query);
            $stmt->bindParam('id', $id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print_r($e->getMessage());
            die();
        }
    }

    public static function create($title, $picture)
    {
        try {
            $query = "INSERT INTO knowledges(name, picture) VALUES(:name, :picture)";
            $stmt = self::prepare($query);
            $stmt->bindParam('name', $title);
            $stmt->bindParam('picture', $picture);
            return $stmt->execute();
        } catch (PDOException $e) {
            print_r($e->getMessage());
            die();
        }
    }


    public static function createDetail($knowledgeId, $name, $text)
    {
        try {
            $query = "INSERT INTO knowledge_details(knowledge_id, name, text) VALUES(:knowledge_id, :name, :text)";
            $stmt = self::prepare($query);
            $stmt->bindParam('knowledge_id', $knowledgeId);
            $stmt->bindParam('name', $name);
            $stmt->bindParam('text', $text);
            return $stmt->execute();
        } catch (PDOException $e) {
            print_r($e->getMessage());
            die();
        }
    }

    public static function editDetail($id, $name, $text)
    {
        try {
            $query = "UPDATE knowledge_details SET name=:name, text=:text WHERE id=:id";
            $stmt = self::prepare($query);
            $stmt->bindParam('id', $id);
            $stmt->bindParam('name', $name);
            $stmt->bindParam('text', $text);
            return $stmt->execute();
        } catch (PDOException $e) {
            print_r($e->getMessage());
            die();
        }
    }

    public static function deleteDetail($id)
    {
        try {
            $query = "DELETE FROM knowledge_details WHERE id=:id";
            $stmt = self::prepare($query);
            $stmt->bindParam('id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            print_r($e->getMessage());
            die();
        }
    }
}
