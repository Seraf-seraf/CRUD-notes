<?php

namespace NotesApp\Database;

use Redis as RedisOriginal;

class Redis
{
    private static $_instance;
    private RedisOriginal $redis;

    private function __construct()
    {
        $this->redis = new RedisOriginal([
           'host' => 'localhost',
           'port' => 6379
        ]);
    }

    /**
     * @return RedisOriginal
     */
    public static function getInstance(): RedisOriginal
    {
        if (!self::$_instance) {
            self::$_instance = new Redis();
        }
        return self::$_instance->redis;
    }
}