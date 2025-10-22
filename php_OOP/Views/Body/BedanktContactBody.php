<?php

require_once ROOT.'Views/Body/BaseBody.php';

class BedanktContactBody extends BaseBody{


    protected string $page;
    protected array $values;
    protected array $errors;

    public function __construct (string $page, array $errors = [], array $values = []){
        $this->page = $page;
        $this->values = $values;
        $this->errors = $errors;
    }

    public function createHtml() : string{
        
        $result = 'Bedankt voor het opnemen van contact, we nemen zo spoedig mogelijk contact met u op. <br>
        Hierbij uw data zoals opgegeven:<br><br>';

        foreach($this -> values as $name => $value){
            $result.= ucfirst($name).': '.$value;
        }
        echo $result;
        return $result;
    }

    public function render(): void{
        echo $this->createHtml();
    }
}