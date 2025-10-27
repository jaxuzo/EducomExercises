<?php

require_once ROOT.'Views/Body/BaseBody.php';
require_once ROOT.'Models/FormModel.php';
require_once ROOT.'Views/Form/Form.php';

class RegisterBody extends BaseBody{

    protected string $page;
    protected array $errors;
    protected array $values;

    public function __construct (string $page, array $errors = [], array $values = []){
        $this->page = $page;
        $this->values = $values;
        $this->errors = $errors;
    }

    public function createHtml(): string{
        $form_model = new FormModel($this->page);
        $form = new Form($this->page, 
                        $form_model->getFormName(), 
                        $form_model->getFieldData(), 
                        $form_model->getSubmitCaption(), 
                        $this->values, 
                        $this->errors);
        return $form->createHtml();
    }

}