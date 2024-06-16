<?php

namespace NotesApp\Database;

class MongoDatabase
{
    private static $_instance;

    private \MongoDB\Client $mongo;

    private function __construct()
    {
        $this->mongo = new \MongoDB\Client('mongodb://localhost:8974');
    }

    public static function getInstance(): \MongoDB\Client
    {
        if (self::$_instance === null) {
            self::$_instance = new MongoDatabase();
        }

        return self::$_instance->mongo;
    }
}
