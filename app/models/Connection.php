<?php


namespace app\models;


use PDO;

/**
 * Class Connection
 * @package app\models
 */
class Connection
{
    /**
     * @return PDO
     */
    public static function connect()
    {
        $pdo = new PDO("mysql:host=localhost;dbname=DBNAME;charset=utf8", "USUARIO", "SENHA");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

        return $pdo;
    }
}
