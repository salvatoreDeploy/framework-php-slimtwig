<?php


namespace app\traits;

use Exception;

/**
 * Trait Read
 * @package app\traits
 */
trait Read
{
    /**
     * @var
     */
    private $sql;
    /**
     * @var
     */
    private $binds;

    /**
     * @param string $fields
     * @return $this
     */
    public function select($fields = '*')
    {
        $this->sql = "select {$fields} from {$this->table}";

        return $this;
    }

    /**
     * @param $args
     * @return $this
     */
    public function order($args)
    {
        $this->sql.= " order by {$args}";

        return $this;
    }

    /**
     * @return mixed
     */
    private function bindAndExecute()
    {
        $select = $this->connect->prepare($this->sql);
        $select->execute($this->binds);

        return $select;
    }


    /**
     * @param $num_args
     * @param $args
     * @return array
     * @throws Exception
     */
    private function whereArgs($num_args, $args){
        if($num_args < 2){
            throw new Exception("Opss, algo errado aconteceu, o where precisa de no minimo 2 argumentos!");
        }

        if($num_args == 2){
            $field = $args[0];
            $sinal = '=';
            $value = $args[1];
        }

        if($num_args == 3){
            $field = $args[0];
            $sinal = $args[1];
            $value = $args[2];
        }

        if($num_args > 3){
            throw new Exception("Opss, algo errado aconteceu, o where não pode ter mais que 3 parametros");
        }

        return [
            'field' => $field,
            'sinal' => $sinal,
            'value' => $value
        ];
    }

    /**
     * @return $this
     * @throws Exception
     */
    public function where()
    {
        $num_args = func_num_args();
        $args = func_get_args();

        $args = $this->whereArgs($num_args, $args);

        $this->sql.= " where {$args['field']} {$args['sinal']} :{$args['field']}";

        $this->binds = [
            $args['field'] => $args['value']
        ];

        return $this;
    }


    /**
     * @return mixed
     */
    public function get()
    {
        $select = $this->bindAndExecute();


        return $select->fetchAll();
    }

    /**
     * @return mixed
     */
    public function first()
    {
        $select = $this->bindAndExecute();

        return $select->fetch();
    }
}