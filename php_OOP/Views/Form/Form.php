<?php
require_once ROOT.'Views/Form/FieldList.php';

class Form extends View
{   
    protected array $values;
    protected array $errors;
    protected string $page;
    protected string $form_name;
    protected string $submit_caption;
    protected array $field_data;
    protected FieldList $field_list;

    public function __construct(string $page, string $form_name, array $field_data, string $submit_caption, array $values = [], array $errors = [])
    {
        $this->page = $page;
        $this->action = htmlspecialchars($_SERVER["PHP_SELF"]);
        $this->errors = $errors;
        $this->values = $values;
        $this->form_name = $form_name;
        $this->submit_caption = $submit_caption;
        $this->field_data = $field_data;
        $this->field_list = new FieldList($field_data, $values, $errors);
    }        
    
    public function createHtml() : string
    {
	return $this->openFormHtml()
	        .$this->field_list->createHtml()
	        .$this->closeFormHtml();
    }    
    
    protected function openFormHtml() : string
    {
        return '<div class="main">'.PHP_EOL
            .'<h2>'.$this->form_name.'</h2>'.PHP_EOL
            .'<p><span class="error">* required field</span></p>'.PHP_EOL
            .'<form action="'.$this->action.'" method="post" >'.PHP_EOL
            .'	<input type="hidden" name="page" value="'.$this->page.'" />'.PHP_EOL;
    }
    
    protected function closeFormHtml() : string
    {
        return '  <button type="submit" value="submit">'.$this->submit_caption.'</button>'.PHP_EOL
            .'</form>'.PHP_EOL
            .'</div>'.PHP_EOL;
    }

    public function render(): void
    {
        echo $this->createHtml();
    }

}    

