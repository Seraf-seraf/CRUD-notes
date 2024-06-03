<?php

namespace NotesApp\Model;

use NotesApp\Database\Database;
use NotesApp\Model\Model;

class Post extends Model
{
    public function __construct()
    {
        static::$db = Database::getInstance()->db;
    }

    protected static $table = 'post';
}