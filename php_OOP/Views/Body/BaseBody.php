<?php


class BaseBody{

    protected string $page;

    public function __construct(string $page){
        $this->page = $page;
    }

    public function render(){
        echo $this->createHtml();
    }

    protected function createHtml()
    {
       return 'string';
    }


}