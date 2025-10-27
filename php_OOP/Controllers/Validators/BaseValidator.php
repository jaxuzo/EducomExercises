<?php

Class BaseValidator{

    protected string $name;
    protected string $value;
    protected string $error;

    public function __construct(string $name){
        $this->name = $name;
        $this->value = '';
        $this->error = '';
    }

    public function validate() : bool{
        //check of de waarde uberhaupt bestaat, dus of het post veld bestaat
        if(!isset($_POST[$this->name])){
            $this->error = 'Deze waarde bestaat niet.';
            return false;
        }

        $value = trim($_POST[$this->name]);
        if(empty($value)){
            $this->error = 'Dit veld is nog leeg.';
            return false;
        }

        $this->value = $value;
        return true;
    }

    public function getError(): string{
        return $this->error;
    }

    public function getValue(): mixed{
        return $this->value;
    }
}
?>