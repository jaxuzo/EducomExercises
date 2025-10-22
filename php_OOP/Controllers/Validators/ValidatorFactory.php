<?php

class ValidatorFactory{

    public function createValidator(string $name, string $type){
        switch($type){
            case 'email':
                require_once ROOT.'Controllers/Validators/EmailValidator.php';
                return new EmailValidator($name);
            case 'number':
                require_once ROOT.'Controllers/Validators/NumberValidator.php';
                return new NumberValidator($name);
            default:
                require_once ROOT.'Controllers/Validators/BaseValidator.php';
                return new BaseValidator($name);
        }
    }
}