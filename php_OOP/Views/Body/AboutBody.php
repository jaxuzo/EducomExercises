<?php

require_once ROOT.'Views/Body/BaseBody.php';

class AboutBody extends BaseBody{

    public function createHtml():string{
        return "<main><p>Autumn breeze whispers,<br> Golden leaves dance on the ground,<br> Silent sky turns gray.</p></main>";
    }

    public function render():void{
        echo $this->createHtml();
    }

}