<?php
require_once ROOT.'Views/Form/Field.php';

class TextArea extends Field
{

    protected function creatInputFieldHtml() : string
    {
        return '<textarea name="'.$this->name.'">'.($this->value ?? '').'</textarea>';
    }       

}
