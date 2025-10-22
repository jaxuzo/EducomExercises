<?php

require_once ROOT.'/Models/MenuModel.php';
require_once ROOT.'/Views/View.php';

class Menu extends View{ 

    private MenuModel $menu_model;

    public function __construct() {
        $this->menu_model =  new MenuModel();       
    }

    protected function openMenuHtml(): string {
        return '<ul class="menu">';
    }

    protected function createMenuItemsHtml(): string {
        $result = '';

        foreach ($this->menu_model->getMenuItems() as $name => $info) {
            $result .= "<li><a href='?page={$name}'>{$info['label']}</a></li>".PHP_EOL;
        } 
        return $result;
    }

    protected function closeMenuHtml(): string {
        return '</ul>'.PHP_EOL;
    }

    public function createHtml() : string
    {
	    return $this->openMenuHtml()
	    .$this->createMenuItemsHtml()
	    .$this->closeMenuHtml();
    }    

    public function render():void{
        echo $this->createHtml();
    }
}
?>