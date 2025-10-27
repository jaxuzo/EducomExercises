<?php
namespace GwForms\Factories;
use GwForms\Fields\BaseField;
class FieldFactory
{
    
    public function createField(string $input_name, string $input_type, string $input_label) : BaseField
    {
        switch ($input_type)
        {
            case "textarea" : 
                return new \GwForms\Fields\TextArea($input_name, $input_label);
            case "email"    : 
                return new \GwForms\Fields\EmailField($input_name, $input_label);
            default :     
                return new BaseField($input_name, $input_type, $input_label);
        }
    }    
}
