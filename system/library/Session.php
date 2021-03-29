<?php

class Session {
    public function __construct()
    {
        session_start();
    }
    
    public function set_data($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function get_data($key)
    {
        return $_SESSION[$key];
    }
}