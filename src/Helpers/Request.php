<?php

namespace App\Helpers;

/**
 * Class Request
 * @package App\Helpers
 */
class Request
{

    /**
     * Get query string
     *
     * @param string $name Identify query
     *
     * @return string|array
     */
    public function getQuery($name = null)
    {
        if (is_null($name)) {
            return $_GET;
        }

        if (isset($_GET[$name])) {
            return $_GET[$name];
        }

        return '';
    }

    /**
     * Get data string
     *
     * @param string $name Identify data
     *
     * @return string|array
     */
    public function getData($name = null)
    {
        if (is_null($name)) {
            return $_POST;
        }

        if (isset($_POST[$name])) {
            return $_POST[$name];
        }

        return '';
    }
}