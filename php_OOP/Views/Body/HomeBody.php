<?php

require_once ROOT.'Views/Body/BaseBody.php';

class HomeBody extends BaseBody{

    public function createHtml():string{
        return "<main><p>Welkom op de hoofdpagina!</p></main>";
    }

    public function render():void{
        echo $this->createHtml();
    }

}