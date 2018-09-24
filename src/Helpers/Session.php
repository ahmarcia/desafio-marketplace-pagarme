<?php

namespace App\Helpers;

/**
 * Class Session
 * @package App\Helpers
 */
class Session
{
    /**
     * Session constructor.
     */
    public function __construct()
    {
        session_start();
        session_cache_limiter(false);
    }

    /**
     * Verify isset value session
     *
     * @param string $name Identify session
     *
     * @return bool
     */
    public function sessionIsset($name)
    {
        return isset($_SESSION[$name]);
    }

    /**
     * Verify isset specify value session
     *
     * @param string $name Identify session
     * @param string $key  Identify value save
     *
     * @return bool
     */
    public function sessionIssetMulti($name, $key)
    {
        return isset($_SESSION[$name][$key]);
    }

    /**
     * Set value session
     *
     * @param string       $name  Identify session
     * @param array|string $value Value to save
     *
     * @return void
     */
    public function set($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    /**
     * Set specify value session
     *
     * @param string       $name  Identify session
     * @param string       $key   Identify value save
     * @param array|string $value Value to save
     *
     * @return void
     */
    public function setMulti($name, $key, $value)
    {
        $_SESSION[$name][$key] = $value;
    }

    /**
     * Get value in session
     *
     * @param string $name Identify session
     *
     * @return string|array
     */
    public function get($name)
    {
        if (isset($_SESSION[$name]))
        {
            return $_SESSION[$name];
        }

        return $_SESSION[$name];
    }

    /**
     * Get specify value session
     *
     * @param string $name Identify session
     * @param string $key  Identify value save
     *
     * @return string|array
     */
    public function getMulti($name, $key)
    {
        if (isset($_SESSION[$name][$key])) {
            return $_SESSION[$name][$key];
        }

        return $_SESSION[$name][$key];
    }

    /**
     * Remove value in session
     *
     * @param string $name Identify session
     *
     * @return void
     */
    public function kill($name)
    {
        unset($_SESSION[$name]);
    }

    /**
     * Remove specify value in session
     *
     * @param string $name Identify session
     *
     * @return void
     */
    public function killMulti($name, $key)
    {
        unset($_SESSION[$name][$key]);
    }

    /**
     * Destroy session
     *
     * @return void
     */
    public function killAll() {
        session_destroy();
    }

    /**
     * Get session user
     *
     * @return array|string
     */
    public function getAuth()
    {
        if ($this->sessionIsset('User')) {
            return $this->get('User');
        }

        return [
            'isGuest' => true,
            'cart' => []
        ];
    }
}
