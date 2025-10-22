<?php

class MenuItem extends View {

    private string $page;
    private string $label;

    public function __construct(string $page, string $label) {
        $this->page = $page;
        $this->label = $label;
    }
    
    public function render(): void {
        echo "<li><a href=\"{$this->page}\">{$this->label}</a></li>";
    }
}