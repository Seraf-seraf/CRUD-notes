<?php

namespace NotesApp\Controller;

use NotesApp\Model\Post;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::findAll();
        return render('core/View/post/index.php', ['posts' => $posts]);
    }

    public function view($id)
    {
        $post = Post::find(['id' => $id]);
        return render('core/View/post/view.php', ['post' => $post]);
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $values = Post::getValues();

            if ($_SESSION['csrf_token'] !== $_POST['csrf_token']) {
                header('HTTP/1.0 403 Forbidden');
                exit();
            }

            $title = $values['title'];
            $note = $values['note'];

            Post::update(['title' => $title, 'note' => $note], $id);
            header('Location: /view/' . $id);
        }
        $post = Post::find(['id' => $id]);

        return render('core/View/post/update.php', ['post' => $post]);
    }

    public function delete($id)
    {
        Post::delete($id);
        header('Location: /');
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $values = Post::getValues();

            if ($_SESSION['csrf_token'] !== $_POST['csrf_token']) {
                header('HTTP/1.0 403 Forbidden');
                exit();
            }

            $title = htmlspecialchars($values['title']);
            $note = htmlspecialchars($values['note']);

            $post = POST::create(['title' => $title, 'note' => $note]);

            header('Location: /view/' . $post->id);
        }

        return render('core/View/post/create.php');
    }
}