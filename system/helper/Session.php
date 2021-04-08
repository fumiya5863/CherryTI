<?php

/*
|--------------------------------------------------------------------------
| Session class
|--------------------------------------------------------------------------
*/

class Session {
    public function __construct()
    {
        session_start();
    }
    
    /**
     * Set session data
     *
     * @param string|array $data
     * @param null|string $value
     * @return void
     */
    public function set($data, $value = null): void
    {   
        if (!is_array($data)) {
            $_SESSION[$data] = $value;
            return;
        }

        foreach($data as $key => $value) {
            $_SESSION[$key] = $value;
        }
    }

    /**
     * Check that the session is set with data
     *
     * @param string $key
     * @return mixed
     */
    public function get(string $key)
    {
        return $_SESSION[$key];
    }

    /**
     * Get all data for the session
     *
     * @return array
     */
    public function all(): array
    {
        return $_SESSION;
    }

    /**
     * Check to see if session data is available.
     *
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    /**
     * Remove session data
     *
     * @param string|array $key
     * @return void
     */
    public function remove($key): void
    {
        if (!is_array($key)) {
            unset($_SESSION[$key]);
            return;
        }

        foreach($key as $k) {
            unset($_SESSION[$k]);
        }
    }

    /**
     * Completely destroy the session.
     *
     * @return void
     */
    public function destroy(): void
    {
        $_SESSION = array();
        setcookie("PHPSESSID", '', time() - 1800, '/');
        session_destroy();
    }
}