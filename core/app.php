<?php

use NotesApp\Controller\AuthController;
use NotesApp\Controller\PostController;
use NotesApp\Model\Post;
use NotesApp\Handler\SessionHandler;
use NotesApp\Model\User;

$sessionHandler = new SessionHandler();
$sessionHandler->checkSession();
Post::init('notes-app');
User::init('notes-app');

$content = '';

$router = new AltoRouter();
$postController = new PostController();
$authController = new AuthController();