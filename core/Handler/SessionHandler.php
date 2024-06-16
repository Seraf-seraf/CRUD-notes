<?php

namespace NotesApp\Handler;

use NotesApp\Database\Redis;
use NotesApp\Model\User;

class SessionHandler
{
    private $redis;

    public function __construct()
    {
        $this->redis = Redis::getInstance();
        $this->redis->select(1);
        session_start();
    }

    public function createSession($user): void
    {
        $this->redis->set($user['_id'], 'session_' . bin2hex(random_bytes(32)), ['EX' => 3600]);
        $_SESSION['user_id'] = $user['_id'];
    }

    public function checkSession(): void
    {
        if (isset($_SESSION['user_id']) && !$this->redis->get($_SESSION['user_id'])) {
            unset($_SESSION['user_id']);
        }
    }
}