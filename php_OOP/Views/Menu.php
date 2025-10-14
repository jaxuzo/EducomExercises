<?php

class Menu { 
    private array $items;

    public function __construct($items = []) {
        //$items = ['home' => 'Home', 'about' => 'About', 'contact' => 'Contact'];
        $this->items = $items;        
    }

    public function render(): string {
        $html = "<ul class='menu'>";
        foreach ($this->items as $name => $label) {
            $html .= "<li><a href='index.php?page=$name'>$label</a></li><br>";
        }
        $html .= "</ul>";
        return $html;
    }
}
?>