<?php

require_once ROOT.'Views/View.php';

class Footer extends View
{

    public function __construct() {} // overschrijven van de constructor omdat Footer geen content nodig heeft

    public function createHtml()
    {
        return "<footer>&copy;&nbsp;" . date("Y") . " Jasper's Website. All rights reserved. </footer>" . PHP_EOL;
    }

    public function render(): void
    {
        echo $this->createHtml();
    }
}
