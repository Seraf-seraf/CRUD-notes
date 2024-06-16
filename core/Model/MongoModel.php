<?php

namespace NotesApp\Model;

use Exception;
use NotesApp\Database\MongoDatabase;
use MongoDB\BSON\ObjectID;

abstract class MongoModel
{
    public static array $fillable = [];
    protected static \MongoDB\Database $db;

    protected static $collection;

    public static function init($db): void
    {
        static::$db = MongoDatabase::getInstance()
            ->selectDatabase($db);
    }

    public static function create(array $data)
    {
        $insertResult = static::$db->selectCollection(static::$collection)->insertOne($data);

        return static::find(['_id' => (string) $insertResult->getInsertedId()]);
    }

    public static function find(array $filter)
    {
        if (isset($filter['_id']) && is_string($filter['_id'])) {
            $filter['_id'] = new ObjectID($filter['_id']);
        }
        return static::$db->selectCollection(static::$collection)->find($filter)->toArray();
    }

    public static function findAll()
    {
        return static::$db->selectCollection(static::$collection)->find()->toArray();
    }

    public static function update(array $data, string $id)
    {
        $updateResult = static::$db->selectCollection(static::$collection)->updateOne(
            ['_id' => new ObjectID($id)],
            ['$set' => $data]
        );

        if ($updateResult->getModifiedCount() === 0) {
            throw new Exception('Model not found!');
        }

        return $updateResult;
    }

    public static function delete($id)
    {
        $deleteResult = static::$db->selectCollection(static::$collection)->deleteOne(['_id' => new ObjectID($id)]);

        if ($deleteResult->getDeletedCount() === 0) {
            throw new Exception('Model not found!');
        }
    }

    public static function getValues()
    {
        $fields = static::$fillable;
        $data = [];

        foreach ($fields as $field) {
            if (!isset($_POST[$field])) {
                throw new \InvalidArgumentException("Попытка сохранить несуществующий атрибут " . static::class);
            }
            $data[$field] = $_POST[$field];
        }

        return $data;
    }
}

