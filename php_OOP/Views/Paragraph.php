<?php

class Paragraph {
    private string $text;
    public function __construct(string $text) { $this->text = $text; }
    public function render(): string { return "<p>{$this->text}</p>"; }
}

?>