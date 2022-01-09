<?php


namespace app\traits;


use app\models\Model;
use app\models\Users;

/**
 * Trait Validations
 * @package app\traits
 */
trait Validations
{
    /**
     * @var array
     */
    private $errors = [];

    /**
     * @param $field
     */
    protected function required($field){

        if(empty($_POST[$field])){
            $this->error[$field][] = flash($field, error('Esse campo é obigatorio'));
        }
    }

    /**
     * @param $field
     */
    protected function email($field){

        if(!filter_var($_POST[$field], FILTER_VALIDATE_EMAIL)){
            $this->errors[$field][] = flash($field, error('Esse campo TEM QUE TER UM E-MAIL VALIDO'));
        }
    }

    /**
     * @param $field
     */
    protected function phone($field){

        if(!preg_match("/^\([1-9]{2}\)(?:[2-8]|9[1-9])[0-9]{3}\-[0-9]{4}$/", $_POST[$field])) {
            $this->errors[$field][] = flash($field, error('Telefone invalido, por favor utilize um telefone valido (XX)xxxxx-xxxx'));
        }
    }

    /**
     * @param $field
     * @param $model
     */
    protected function unique($field, $model){

        $model = new Users();

        $find = $model->select()->where($field, $_POST[$field])->first();


        if($find && !empty($_POST[$field])){
            $this->errors[$field][] = flash($field, error('Dado ja cadastrado'));
        }
    }

    /**
     * @param $field
     * @param $max
     */
    protected function max($field, $max){

        if(strlen($_POST[$field]) > $max){
            $this->errors[$field][] = flash($field, error('O numero maximo de caracteres é ' . $max));
        }
    }

    /**
     * @return bool
     */
    public function hasErrors()
    {
        return !empty($this->errors);
    }

}