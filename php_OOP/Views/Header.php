<?php

require_once ROOT.'Models/HeaderModel.php';
require_once ROOT.'Views/View.php';

class Header extends View{

    private string $page;

    public function __construct(string $page) {
        $this->page = $page;
    }

    private function getTitle($page) : string{
        $header_model = new HeaderModel();
        return $header_model->getHeader($page);
    }
    
    public function createHtml(){
        return "<div class = 'header'> 
                <h1>{$this->getTitle($this->page)}</h1>
                </div>".PHP_EOL; 
    }

    public function render(): void {
        echo $this->createHtml();
    }

}

?>