<?php

class Field{
    
    private string $value;
    protected string $name;
    protected string $type;
    protected string $label;
    protected string $error;

    public function __construct(string $name, array $info, string $value = '', string $error = ''){
        $this -> name = $name;
        $this -> type = $info['type'];
        $this -> label = $info['label'] ?? '';
        $this -> value = $value;
        $this -> error = $error;
    }

    protected function createLabelHtml() : string
    {
        return '<label for="'.$this->name.'" >'.$this->label.'</label>';
    }        
    
    protected function creatInputFieldHtml(): string {
            return '<input type="'.$this->type.'" id="'.$this->name.'" name="'.$this->name.'" value ="'.($this->value ?? '').'">'.PHP_EOL;
    }

    protected function createErrorHtml() : string
    {
        return '<span class="error"> * '.$this->error.'</span><br/>';
    }        

    public function createHtml(): string
    {
        return $this->createLabelHtml()
                .$this->creatInputFieldHtml()
                .$this->createErrorHtml();
    }

    public function getType():string{
        return $this->type;
    }

    public function getName():string{
        return $this->name;
    }

    public function getLabel():string{
        return $this->label;
    }

    public function setError(string $error):void{
        $this->error = $error;
    }

    public function setValue(string $value):void{
        $this->value = $value;
    }

    public function render(): void
    {
        echo $this->createHtml();
    }
    
}
?>