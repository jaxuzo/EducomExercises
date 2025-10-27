<?php
namespace GwForms\Fields;
class TextArea extends BaseField
{
    public function __construct(string $input_name, string $input_label)
    {
        parent::__construct($input_name,'',$input_label);
    }
    
    protected function showField() : void
    {
        echo '<textarea name="'.$this->name.'">'.$this->value.'</textarea><br/>';
    }        
}
