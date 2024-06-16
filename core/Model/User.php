<?php

namespace NotesApp\Model;

use NotesApp\Database\Database;
use NotesApp\Database\MongoDatabase;

class User extends MongoModel
{
    public static array $fillable = [
        'login',
        'password'
    ];

    protected static $collection = 'user';
}