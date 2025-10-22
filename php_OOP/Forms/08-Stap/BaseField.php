<?php
class BaseField
{
    protected string $name;
    protected string $type;
    protected string $label;
    protected string $error;
    protected mixed $value;
    
    public function __construct(string $input_name, string $input_type, string $input_label)
    {
        $this->name = $input_name;
        $this->type = $input_type;
        $this->label = $input_label;
        $this->error = '';
        $this->value = '';
        
    }   
    
    public function getValue() : mixed
    {
        return $this->value;
    }        

    public function getName() : string
    {
        return $this->name;
    }        
    
    public function show() : void
    {
        $this->showLabel();
        $this->showField();
        if (!empty($this->error)) $this->showError();
    }        
    
    public function validate() : bool
    {
        $value = filter_input(INPUT_POST,$this->name,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (is_null($value))
        {    
            $this->error = $this->label.' not found.';
            return false;
        }    
        if ($value===false)
        {
            $this->error = $this->label.' is invalid';
            return false;
        }  
        $value = trim($value);
        if (empty($value))
        {
            $this->error = $this->label.' is empty';
            return false;
        }
        $this->value = $value;
        return true;
    }        
    
    protected function showLabel() : void
    {
        echo '<label for="'.$this->name.'" >'.$this->label.'</label><br/>';
    }        

    protected function showField() : void
    {
        echo '<input type="'.$this->type.'" name="'.$this->name.'"  value="'.$this->value.'" /><br/>';
    }        
    
    protected function showError() : void
    {
        echo '<span class="input_error">'.$this->error.'</span><br/>';
    }        
    
}
