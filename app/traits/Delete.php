<?php


namespace app\traits;


/**
 * Trait Delete
 * @package app\traits
 */
trait Delete
{
    /**
     * @return mixed
     * @throws \Exception
     */
    public function delete()
    {
        if(!isset($this->field) || !isset($this->value)){
            throw new \Exception("Antes de fazer o 'DELETE', por favor execute o metodo 'find()'");
        }

        $sql = "delete from {$this->table} where {$this->field} = :{$this->field}";

        $delete = $this->connect->prepare($sql);
        $delete->bindValue($this->field,$this->value);
        $delete->execute();

        return $delete->rowCount();
    }
}