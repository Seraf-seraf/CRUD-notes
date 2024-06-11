<?php
/** @var AltoRouter $router */

/** @var \NotesApp\Controller\PostController $postController */
/** @var \NotesApp\Controller\AuthController $authController */

require_once 'vendor/autoload.php';
require_once 'helper/helper.php';
require_once 'core/app.php';

try {
    $router->map('GET', '/', function () use ($postController, &$content) {
        $content = $postController->index();
    });

    $router->map('GET|POST', '/create', function () use ($postController, &$content) {
        getAuth();
        $content = $postController->create();
    });
    $router->map('GET|POST', '/update/[i:id]', function ($id) use ($postController, &$content) {
        getAuth();
        $content = $postController->update($id);
    });
    $router->map('GET', '/delete/[i:id]', function ($id) use ($postController, &$content) {
        getAuth();
        $postController->delete($id);
    });
    $router->map('GET', '/logout', function () {
        getAuth();
        unset($_SESSION['user_id']);
        header('Location: /');
    });

    $router->map('GET', '/view/[i:id]', function ($id) use ($postController, &$content) {
        $content = $postController->view($id);
    });

    $router->map('GET|POST', '/registration', function () use ($authController, &$content) {
        $content = $authController->register();
    });

    $router->map('GET|POST', '/login', function () use ($authController, &$content) {
        $content = $authController->login();
    });

    $match = $router->match();

    call_user_func_array($match['target'] ?? null, $match['params'] ?? null);
} catch (InvalidArgumentException $exception) {
    $content = $exception->getMessage();
}

print render('core/View/layout.php', ['content' => $content]);
