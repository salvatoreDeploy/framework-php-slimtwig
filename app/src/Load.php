<?php


namespace app\src;


/**
 * Class Load
 * @package app\src
 */
class Load
{
    /**
     * @param $file
     * @return mixed
     * @throws \Exception
     */
    public static function file($file){
        $file = path().$file;

        if(!file_exists($file)){
            throw new \Exception("Esse arquivo não existe: {$file}");
        }

        return require $file;
    }
}