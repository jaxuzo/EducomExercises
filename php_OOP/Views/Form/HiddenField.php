<?php

Require_once ROOT.'Views/Form/Field.php';

class HiddenField extends Field{

    private string $hidden_value;

    public function __construct(string $name, array $info){
        $this->name = $name;
        $this -> hidden_value = $info['value'];
    }
    
    public function createHtml(): string{
        return '<input type="hidden" name ="'.$this->name.'" value = "'.($this->hidden_value).'">';
    }
}

?>