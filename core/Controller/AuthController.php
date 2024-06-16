<?php

namespace NotesApp\Controller;

use NotesApp\Database\Redis;
use NotesApp\Handler\SessionHandler;
use NotesApp\Model\User;

class AuthController extends Controller
{
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $values = User::getValues();

            if ($_SESSION['csrf_token'] !== $_POST['csrf_token']) {
                header('HTTP/1.0 403 Forbidden');
                die();
            }

            $login = $values['login'];

            if (User::find(['login' => $login])) {
                $this->errors['register'] = 'Пользователь с таким логином уже существует!';
            }

            if (empty($login)) {
                $this->errors['login'] = 'Логин не может быть пустым';
            }

            if (empty($this->errors)) {
                $password = password_hash($values['password'], PASSWORD_BCRYPT);
                $user = User::create(['login' => $login, 'password' => $password]);

                $sessionHandler = new SessionHandler();
                $sessionHandler->createSession($user);


                header('Location: /');
                die();
            }
        }

        return render('core/View/auth/register.php', ['errors' => $this->errors]);
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $values = User::getValues();

            if ($_SESSION['csrf_token'] !== $_POST['csrf_token']) {
                header('HTTP/1.0 403 Forbidden');
                die();
            }
            $login = $values['login'];

            $user = User::find(['login' => $login])[0];

            if ($user && password_verify($values['password'], $user['password'])) {
                $sessionHandler = new SessionHandler();
                $sessionHandler->createSession($user);

                header('Location: /');
                die();
            }

            $this->errors['login'] = 'Неправильный логин или пароль';
        }

        return render('core/View/auth/login.php', ['errors' => $this->errors]);
    }
}