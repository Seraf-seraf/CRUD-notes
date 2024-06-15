<?php

namespace NotesApp\Model;

use Exception;
use NotesApp\Database\Database;
use PDO;

abstract class Model
{
    public static array $fillable = [];
    protected static $db;
    protected static $table;

    public static function init()
    {
        static::$db = Database::getInstance()->db;
    }

    public static function create(array $data)
    {
        $data = static::prepareData($data);

        $sql = "INSERT INTO " . static::$table . " (" . implode(", ", array_keys($data)) . ") VALUES (" . mb_substr(
                str_repeat('?, ', count($data)),
                0,
                -2
            ) . ")"; // insert into $table (k1, k2, k3) values (?, ?, ?)
        $stmt = static::$db->prepare($sql);
        $stmt->execute(array_values($data));

        $id = static::$db->lastInsertId();
        return static::find(['id' => $id]);
    }

    protected static function prepareData($data)
    {
        foreach ($data as &$value) {
            $value = htmlspecialchars($value);
        }

        return $data;
    }

    protected static function getColumns()
    {
        $sql = "SHOW COLUMNS FROM " . static::$table;
        $stmt = static::$db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public static function find(array $data)
    {
        $condition = implode('AND ', static::getKeysWithMasks($data));

        $sql = "SELECT * FROM " . static::$table . " WHERE {$condition}";
        $stmt = static::$db->prepare($sql);
        $stmt->execute(array_values($data));

        return $stmt->fetchObject(static::class);
    }

    protected static function getKeysWithMasks($data)
    {
        $condition = [];
        foreach ($data as $key => $value) {
            $condition[] = "{$key} = ?";
        }
        return $condition;
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
        if (!static::find(['id' => $id])) {
            throw new Exception('Model not found!');
        }

        $data = static::prepareData($data);
        $setClause = implode(', ', static::getKeysWithMasks($data));
        $sql = "UPDATE " . static::$table . " SET " . $setClause . " WHERE id = ?";
        $stmt = static::$db->prepare($sql);
        $params = array_merge(array_values($data), [$id]);
        $stmt->execute($params);
    }

    public static function delete($id)
    {
        if (!static::find($id)) {
            throw new Exception('Model not found!');
        }
        $sql = "DELETE FROM " . static::$table . " WHERE id = ?";
        $stmt = static::$db->prepare($sql);
        $stmt->execute([$id]);
    }

    public static function getValues()
    {
        $fields = static::$fillable;
        $data = [];

        foreach ($fields as $field) {
            if (!isset($_POST[$field])) {
                throw new \InvalidArgumentException("Попытка сохранить несуществующий атрибут " . static::class);
            }
            $data[$field] = htmlspecialchars($_POST[$field]);
        }

        return $data;
    }
}
