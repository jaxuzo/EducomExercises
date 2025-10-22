<?php

require_once ROOT.'Models/FormModel.php';
require_once ROOT.'Views/Form/Form.php';
require_once ROOT.'Views/Body/BaseBody.php';

class ContactBody extends BaseBody{

    protected string $page;
    protected array $values;
    protected array $errors;

    public function __construct (string $page, array $errors = [], array $values = []){
        $this->page = $page;
        $this->values = $values;
        $this->errors = $errors;
    }

    public function createHtml() : string{

        $formModel = new FormModel($this->page);
        $form = new Form($this->page, $formModel->getFormName(), $formModel->getFieldData(), $formModel->getSubmitCaption(), $this->values, $this->errors);

        return $form->createHtml();
    }

    public function render(): void{
        echo $this->createHtml();
    }

}

?>