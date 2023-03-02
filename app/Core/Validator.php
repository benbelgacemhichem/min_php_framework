<?php

namespace App\Core;

class Validator
{

    public function validate(array $fields)
    {
        $validations = [];

        foreach ($fields as $key => $value) {
            $field = new \stdClass();
            $field->$key = explode('|', $value);
            array_push($validations, $field);
        }

        $d = json_decode(json_encode($validations), true);

        foreach ($d as $key => $value) {
            echo $key;
            print_r($value);
            echo '<br/>';
        }
    }

    public function required($value)
    {
        $value = trim($value);
        
        return strlen($value) > 0;
    }
    
    public function string($value, $min = 1, $max= INF)
    {
        $value = trim($value);
        
        return strlen($value) >= $min && strlen($value) <= $max;
    }
}
