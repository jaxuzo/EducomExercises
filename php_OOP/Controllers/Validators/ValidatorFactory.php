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
            case 'password':
                if ($name == 'wwlogin'){
                    //login checkt niet of wachtwoord goed is opgesteld
                    require_once ROOT.'Controllers/Validators/BaseValidator.php';
                    return new BaseValidator($name);
                }
                else{
                    //alle andere wachtwoorden worden wel op dit moment
                    require_once ROOT.'Controllers/Validators/PasswordValidator.php';
                    return new PasswordValidator($name);
                }
            default:
                require_once ROOT.'Controllers/Validators/BaseValidator.php';
                return new BaseValidator($name);
        }
    }
}