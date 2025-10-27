<?php

class RegisterValidator{

    protected array $db_values;
    protected array $errors;

    public function __construct(array $db_values){
        $this->db_values = $db_values;
        $this->errors = [];
    }

    public function validate(): bool{
        if(isset($this->db_values)){
            $this->errors['email'] = 'Er is al een gebruiker met deze email!<br>';
            return false;
        }
        echo '<br> Er is niks aan het handje, data is helemaal goed!<br>';
        return true;
    }

    public function getError(): array{
        return $this->errors;
    }

}