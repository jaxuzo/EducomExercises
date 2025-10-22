<?php

require_once ROOT.'Controllers/Validators/BaseValidator.php';

class NumberValidator extends BaseValidator{

    public function validate(): bool{
        
        $result = parent::validate();
        //dus als de basischeck oke is
        if ($result){
            if(!filter_var($this->value, FILTER_VALIDATE_INT)){
                $result = false;
                $this->error = 'Waarde is geen getal. <br>';
                //$this->value = '' Waarde weggooien of bewaren afhankelijk van hoe ik de form wil laten zien
            }
        }
        return $result;

    }


}