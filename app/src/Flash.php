<?php


namespace app\src;


/**
 * Class Flash
 * @package app\src
 */
class Flash
{
    /**
     * @param $index
     * @param $message
     */
    public static function add($index, $message)
    {
        if(!isset($_SESSION[$index])){
            $_SESSION[$index] = $message;
        }
    }

    /**
     * @param $index
     * @return mixed|string
     */
    public static function get($index)
    {
        if(isset($_SESSION[$index])){
            $message = $_SESSION[$index];
        }

        unset($_SESSION[$index]);

        return $message ?? '';
    }
}