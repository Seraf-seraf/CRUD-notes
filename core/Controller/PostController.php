<?php

namespace NotesApp\Controller;

use NotesApp\Model\Post;

class PostController
{
    public function index()
    {
        $posts = Post::findAll();
        return render('core/View/index.php', ['posts' => $posts]);
    }

    public function view($id)
    {
        $post = Post::find($id);
        return render('core/View/view.php', ['post' => $post]);
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = htmlspecialchars($_POST['title']);
            $note = htmlspecialchars($_POST['note']);
            Post::update(['title' => $title, 'note' => $note], $id);
            header('Location: /view/' . $id);
        }
        $post = Post::find($id);
        return render('core/View/update.php', ['post' => $post]);
    }

    public function delete($id)
    {
        Post::delete($id);
        return render('core/View/index.php', ['posts' => Post::findAll()]);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = htmlspecialchars($_POST['title']);
            $note = htmlspecialchars($_POST['note']);

            $post = POST::create(['title' => $title, 'note' => $note]);

            return render('core/View/view.php', ['post' => $post]);
        }

        return render('core/View/create.php');
    }
}