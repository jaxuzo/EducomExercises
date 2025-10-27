<?php

class PasswordValidator extends BaseValidator{

    public function validate() : bool{
        $result = parent::validate();
        $value = $_POST[$this->name];

        if ($result){
            if(strlen($value) <= 5){
                $this-> error = 'Wachtwoord moet minimaal 6 letters bevatten <br>';
                return false;
            }
            // Nu nog hardcoded check voor register. Kan veranderen.
            elseif ($this->name == 'wwregister'){
                $confirm = $_POST['wwregister2'];
                if ($_POST['wwregister'] !== $confirm){
                    echo '<br> Ho! Ik zie dat je herhalings wachtwoord niet hetzelfde is! <br>';
                    $this-> error = 'Wachtwoorden komen niet overeen<br>';
                    return false;
                }
            }
            elseif ($this->name == 'wwregister2'){
                $original = $_POST['wwregister'];
                if ($_POST['wwregister2'] !== $original){
                    echo '<br> En ja hoor, deze dan natuurlijk ook niet <br>';
                    $this-> error = '';
                    return false;
                }
            }
        }
        return $result;

    }
}