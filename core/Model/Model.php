<?php
namespace NotesApp\Model;

use Exception;
use NotesApp\Database\Database;
use \PDO;

abstract class Model
{
    protected static $db;
    protected static $table;

    public static function init()
    {
        static::$db = Database::getInstance()->db;
    }

    public static function create(array $data)
    {
        $data = static::prepareData($data);

        $sql = "INSERT INTO " . static::$table . " (" . implode(", ", array_keys($data)) . ") VALUES (" . mb_substr(str_repeat('?, ', count($data)), 0, -2) . ")";
        $stmt = static::$db->prepare($sql);
        $stmt->execute(array_values($data));

        $id = static::$db->lastInsertId();
        return static::find($id);
    }

    public static function find($id)
    {
        $sql = "SELECT * FROM " . static::$table . " WHERE id = ?";
        $stmt = static::$db->prepare($sql);
        $stmt->execute([$id]);

        $result = $stmt->fetchObject(static::class);

        if (!$result) {
            throw new Exception('Model not found!');
        }

        return  $result;
    }

    public static function findAll()
    {
        $sql = "SELECT * FROM " . static::$table;
        $stmt = static::$db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, static::class);
    }

    public static function update(array $data, $id)
    {
        if (!static::find($id)) {
            throw new Exception('Model not found!');
        }

        $data = static::prepareData($data);

        $setClause = implode(" = ?, ", array_keys($data)) . " = ?";
        $sql = "UPDATE " . static::$table . " SET " . $setClause . " WHERE id = ?";
        $stmt = static::$db->prepare($sql);
        $params = array_merge(array_values($data), [$id]);
        $stmt->execute($params);

        return static::find($id);
    }

    public static function delete($id)
    {
        if (!static::find($id)) {
            throw new Exception('Model not found!');
        }
        $sql = "DELETE FROM " . static::$table . " WHERE id = ?";
        $stmt = static::$db->prepare($sql);
        return $stmt->execute([$id]);
    }

    protected static function prepareData($data)
    {
        foreach ($data as &$value) {
            $value = htmlspecialchars($value);
        }

        return $data;
    }
}
