<?php

use NotesApp\Controller\AuthController;
use NotesApp\Controller\PostController;
use NotesApp\Database\Database;
use NotesApp\Model\Post;

Database::getInstance()
    ->connect(
        'mysql:host=localhost;dbname=notesapp;charset=utf8',
        'root',
        ''
    );

$content = '';
Post::init();
$postController = new PostController();
$authController = new AuthController();
$router = new AltoRouter();
session_start();