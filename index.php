<?php
require_once 'vendor/autoload.php';
require_once 'helper/helper.php';

use NotesApp\Database\Database;
use NotesApp\Model\Post;
use NotesApp\Controller\PostController;

$db = Database::getInstance()
    ->connect(
        'mysql:host=localhost;dbname=notesapp;charset=utf8',
        'root',
        ''
    );
Post::init();
$postController = new PostController();

$requestMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

try {
    if ($uri == '/index') {
        $content = $postController->index();
    } elseif($uri == '/create') {
        $content = $postController->create();
    } elseif (str_starts_with($uri, '/view/')) {
        $array = explode('/', $uri);
        $id = intval(end($array));
        $content = $postController->view($id);
    } elseif (str_starts_with($uri, '/update/')) {
        $array = explode('/', $uri);
        $id = intval(end($array));
        $content = $postController->update($id);
    } elseif (str_starts_with($uri, '/delete/')) {
        $array = explode('/', $uri);
        $id = intval(end($array));
        $content = $postController->delete($id);
    } else {
        $content = $postController->index();
    }
} catch (Exception $exception) {
    $content = $exception->getMessage();
}

print render('core/View/layout.php', ['content' => $content]);
