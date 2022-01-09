<?php


namespace app\models;



use app\traits\Create;
use app\traits\Delete;
use app\traits\Read;
use app\traits\Update;

/**
 * Class Model
 * @package app\models
 */
class Model
{
    use Create, Read, Update, Delete;

    /**
     * @var \PDO
     */
    protected $connect;
    /**
     * @var
     */
    protected $field;
    /**
     * @var
     */
    protected $value;

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->connect = Connection::connect();
    }

    /**
     * @return array
     */
    public function all()
    {
        $sql = "select * from {$this->table}";
        $all = $this->connect->query($sql);
        $all->execute();

        return $all->fetchAll();
    }

    /**
     * @param $field
     * @param $value
     * @return $this
     */
    public function find($field, $value)
    {
        $this->field = $field;
        $this->value = $value;

        return $this;
    }

    /**
     * @param $field
     * @param $value
     * @return int
     */
    public function destroy($field, $value)
    {
        $sql = "delete from {$this->table} where {$field} = :{$field}";

        $destroy = $this->connect->prepare($sql);
        $destroy->bindValue($field,$value);
        $destroy->execute();

        return $destroy->rowCount();
    }

}