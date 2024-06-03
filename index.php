<?php
require_once 'vendor/autoload.php';

use NotesApp\Database\Database;
use NotesApp\Model\Post;
use NotesApp\Model\User;

$db = Database::getInstance()
    ->connect(
        'mysql:host=localhost;dbname=notesapp;charset=utf8',
        'root',
        ''
    );
Post::init();
User::init();
$post_1 = Post::create(['title' => 'Запись №1', 'note' => 'Тестовая запись']);
$post_2 = Post::create(['title' => 'Запись №2', 'note' => 'Здесь кто-то был!']);

$posts = [$post_1, $post_2];

foreach ($posts as $post) {
    echo $post->id . PHP_EOL;
    echo $post->title . PHP_EOL;
    echo $post->note . PHP_EOL;
    echo $post->date_created . PHP_EOL . PHP_EOL;
}

$post = Post::find(30);
echo $post->title;

Post::update(['title' => 'Сломанная запись'], 30);
Post::delete(30);

$user = User::create([
    'name' => 'Serafim',
    'password' => password_hash('qwerty', PASSWORD_DEFAULT)
]);

var_dump(User::findAll());