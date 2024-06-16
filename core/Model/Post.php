<?php

namespace NotesApp\Model;

use NotesApp\Database\Database;
use NotesApp\Database\MongoDatabase;

class Post extends MongoModel
{
    public static array $fillable = [
        'title',
        'note'
    ];

    protected static $collection = 'post';
}