<?php

namespace NotesApp\Model;

use NotesApp\Database\Database;

class User extends Model
{
    public static array $fillable = [
        'login',
        'password'
    ];
    protected static $table = 'user';

    public function __construct()
    {
        static::$db = Database::getInstance()->db;
    }
}