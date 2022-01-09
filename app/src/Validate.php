<?php


namespace app\src;


use app\traits\Sanitize;
use app\traits\Validations;

/**
 * Class Validate
 * @package app\src
 */
class Validate
{
    use Validations, Sanitize;

    /**
     * @param $field
     * @param $validation
     * @return string
     */
    private function validationWithParameter($field, $validation){

        $validations = [];

        if(substr_count($validation, '@') > 0){
            $validations = explode(':', $validation);
        }

        foreach ($validations as $key => $value){
            if(substr_count($value, '@') > 0){
                list($validationWithParameter, $parameter) = explode('@', $value);

                //dd($validationWithParameter);
                //dd($parameter);

                $this->$validationWithParameter($field, $parameter);

                unset($validations[$key]);

                $validation = implode(':', $validations);
            }
        }

        return $validation;
    }

    /**
     * @param $validate
     * @return bool
     */
    private function hasOneValidation($validate){
        return substr_count($validate, ':') == 0;
    }

    /**
     * @param $validate
     * @return bool
     */
    private function hasTwoMoreValidation($validate){
        return substr_count($validate, ':') >= 1;
    }

    /**
     * @param $rules
     * @return object
     */
    public function validate($rules)
    {
        foreach ($rules as $field => $validation){

            $validation = $this->validationWithParameter($field, $validation);

            //dd($validations);
            //dd($validation);

            if($this->hasOneValidation($validation)){
                $this->$validation($field);
            }

            if($this->hasTwoMoreValidation($validation)){
                $validations = explode(':', $validation);

                foreach ($validations as $validation){
                    $this->$validation($field);
                }
            }
        }

        return (object)$this->sanitize();
    }
}