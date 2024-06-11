<?php

namespace NotesApp\Controller;

abstract class Controller
{

    public function __construct()
    {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        $this->errors = [];
    }
}