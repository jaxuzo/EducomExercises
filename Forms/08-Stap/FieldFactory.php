<?php
require_once 'BaseField.php';
class FieldFactory
{
    
    public function createField(string $input_name, string $input_type, string $input_label) : BaseField
    {
        switch ($input_type)
        {
            case "textarea" : 
                require_once 'TextArea.php';
                return new TextArea($input_name, $input_label);
            case "email"    : 
                require_once 'EmailField.php';
                return new EmailField($input_name, $input_label);
            default :     
                return new BaseField($input_name, $input_type, $input_label);
        }
    }    
}
