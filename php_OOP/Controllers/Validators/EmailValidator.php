<?php

require_once ROOT.'Controllers/Validators/BaseValidator.php';

class EmailValidator extends BaseValidator{

    public function validate(): bool{
        
        $result = parent::validate();
        if ($result){
            if(!filter_var($this->value, FILTER_VALIDATE_EMAIL)){
                $result = false;
                $this->error = 'Ongeldig email adress. <br>';
                //$this->value = '' Waarde weggooien of bewaren afhankelijk van hoe ik de form wil laten zien
            }
        }
        return $result;

    }

}

