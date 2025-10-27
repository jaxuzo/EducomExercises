<?php

class LoginValidator{

    protected array $db_values;
    protected array $errors;

    public function __construct(?array $db_values){
        $this->db_values = $db_values ?? [];
        $this->errors = [];
    }

    public function validate(): bool{
        if(empty($this->db_values)){
            $this->errors['email'] = 'Er is geen gebruiker met deze email';
            return false;
        }
        //Is wachtwoord correct?
        if($this->db_values['password'] !== $_POST['wwlogin']){
            $this->errors['wwlogin'] = 'Het wachtwoord is niet juist<br>';
            return false;
        }
        echo '<br> Er is niks aan het handje, data is helemaal goed!<br>';
        return true;
    }

    public function getError(): array{
        return $this->errors;
    }

}