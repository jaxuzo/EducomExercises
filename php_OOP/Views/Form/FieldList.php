<?php

require_once ROOT.'Views/Form/TextArea.php';
require_once ROOT.'Views/Form/HiddenField.php';
require_once ROOT.'Views/Form/Field.php';

class FieldList{

    //Deze functie gaat vanuit de array van FormModel de html fields opstellen voor de form

    protected array $fieldData;
    protected array $values;
    protected array $errors;
    protected array $fields;

    public function __construct(array $fieldData, array $values = [], array $errors = []){
        $this->fieldData = $fieldData;
        $this->errors = $errors;
        $this->values = $values;
        $this->fields = [];
    }

    private function createFields() : void { 
        // Maak een array waar de verschillende objecten van de velden zitten. Dus voor ieder veld 1 object.
        foreach ($this->fieldData as $name => $info){
            
            $value = $this -> values[$name] ?? '';
            $error = $this -> errors[$name] ?? '';

            switch($info['type']){
                case 'textarea':
                    $this->fields[]= new TextArea($name, $info, $value, $error);
                    break;
                case 'hidden':
                    $this->fields[]= new HiddenField($name, $info);
                    break;
                default:
                    $this->fields[]= new Field($name, $info, $value, $error);
            }
            
        }
    }

    public function getFields(): array{
        return $this->fields;
    }

    public function createHtml() : string{

        $result = '';

        if (count($this->fields) == 0){
            $this->createFields();
        }

        foreach($this->fields as $field){
            $result.= $field->createHtml();
        }

        return $result;
    }

    public function render() :void{
        echo $this->createHtml();
    }
}


?>