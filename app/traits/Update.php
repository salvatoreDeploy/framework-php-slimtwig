<?php


namespace app\traits;


/**
 * Trait Update
 * @package app\traits
 */
trait Update
{
    /**
     * @param $atributes
     * @return mixed
     * @throws \Exception
     */
    public function update($atributes)
    {

        if(!isset($this->field) || !isset($this->value)){
            throw new \Exception("Antes de fazer o 'UPDATE', por favor execute o metodo 'find()'");
        }

        $sql = "update {$this->table} set ";

        foreach ($atributes as $field => $value){
            $sql .= $field . "= :{$field},";
        }

        $sql = rtrim($sql, ',');

        $sql .= " where {$this->field} = :{$this->field}";

        $atributes['id'] = $this->value;

        $update = $this->connect->prepare($sql);
        $update->execute($atributes);

        return $update->rowCount();

    }
}