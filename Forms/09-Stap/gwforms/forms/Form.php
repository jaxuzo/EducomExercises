<?php
namespace GwForms\Forms;
use GwForms\Collections\FieldCollection;
class Form
{
    protected string $page;
    protected string $action;
    protected string $method;
    protected string $submit_caption;
    protected FieldCollection $field_collection;
    
    
    public function __construct(string $page, string $action, string $method, string $submit_caption, FieldCollection $field_collection)
    {
        $this->page = $page;
        $this->action = $action;
        $this->method = $method;
        $this->submit_caption = $submit_caption;
        $this->field_collection = $field_collection;
    }        
    
    public function show() : void
    {
	$this->openForm();
	$this->showFields();
	$this->closeForm();
    }    
    
    protected function openForm() : void
    {
        echo '<form action="'.$this->action.'" method="'.$this->method.'" >'.PHP_EOL
                    .'	<input type="hidden" name="page" value="'.$this->page.'" />'.PHP_EOL;
    }

    protected function showFields() : void
    {
        foreach ($this->field_collection->getFields() as $field)
        {
            $field->show();
        }
    }
    
    protected function closeForm() : void
    {
        echo '  <button type="submit" value="submit">'.$this->submit_caption.'</button>'.PHP_EOL
            .'</form>'.PHP_EOL;
    }
}    
