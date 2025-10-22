<?php
require_once ROOT.'Controllers/BodyFactory.php';
require_once ROOT.'Views/Header.php';
require_once ROOT.'Views/Footer.php';
require_once ROOT.'Views/Menu.php';
require_once ROOT.'Views/View.php';

class PageView extends View {
   
    protected string $title;
    protected string $page;
    protected array $errors;
    protected array $values;
    protected Header $header;
    protected Footer $footer;
    protected Menu $menu;

    protected BodyFactory $body_factory;

    public function __construct(string $page, array $errors = [], array $values = []) {
        $this->errors = $errors;
        $this->values = $values;
        $this->page = $page;
        $this->header = new Header($page);
        $this->menu = new Menu();
        $this->body_factory = new BodyFactory();
        $this->footer = new Footer();
    }

    public function render(): void {
        $this->header->render();
        $this->menu->render();
        $this->body_factory->createBody($this->page, $this->errors, $this->values)->render();
        $this->footer->render();
    }
}

?>