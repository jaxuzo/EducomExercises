<?php

require_once ROOT.'Controllers/Validators/ValidatorFactory.php';

class FormValidator
{

    protected array $field_info;
    protected array $values;
    protected array $errors;

    public function __construct(array $field_info)
    {
        $this->field_info = $field_info;
        $this->values = [];
        $this->errors = [];
    }

    public function validate(): bool
    {

        $result = true;

        $validator_factory = new ValidatorFactory();

        foreach ($this->field_info as $name => $info) {
            $validator = $validator_factory->createValidator($name, $info['type']);

            if (!$validator->validate()) {
                $this->errors[$name] = $validator->getError();
                $result = false;
            }

            else {
                $this->values[$name] = $validator->getValue();
            }
        }
        return $result;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function getValues(): array
    {   
        return $this->values;
    }
}
