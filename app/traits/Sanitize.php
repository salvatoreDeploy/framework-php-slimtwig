<?php


namespace app\traits;


/**
 * Trait Sanitize
 * @package app\traits
 */
trait Sanitize
{
    /**
     * @return array
     */
    protected function sanitize(){
        $sanitized = [];

        foreach ($_POST as $field => $value){
            $sanitized[$field] = filter_var($value, FILTER_SANITIZE_STRING);
        }

        return $sanitized;
    }
}