<?php


namespace app\traits;


/**
 * Trait Create
 * @package app\traits
 */
trait Create
{
    /**
     * @param $atributes
     * @return mixed
     */
    public function create($atributes)
    {
        $sql = "insert into {$this->table}(";
        $sql .= implode(',', array_keys($atributes)) . ") values(";
        $sql .= ":" . implode(', :', array_keys($atributes)) . ")";

        $create = $this->connect->prepare($sql);
        $create->execute($atributes);

        return $this->connect->lastInsertId();

        //dd($sql);
    }
}