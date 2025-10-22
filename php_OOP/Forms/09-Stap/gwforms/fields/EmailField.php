<?php
namespace GwForms\Fields;
class EmailField extends BaseField
{
    public function __construct(string $input_name, string $input_label)
    {
        parent::__construct($input_name,'email',$input_label);
    }
    
    public function validate() : bool
    {
        if (parent::validate()===false)
        {
            return false;
        }
        $value = filter_var($this->value, FILTER_VALIDATE_EMAIL, FILTER_NULL_ON_FAILURE);
        if (is_null($value))
        {
            $this->error = $this->label.' is not a valid email';
            $this->value = '';
            return false;
        } 
        return true;
    }    
}
