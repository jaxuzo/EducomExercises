<?php

class Header {
    private string $title;
    public function __construct(string $title) { $this->title = $title; }
    public function render(): string { return "<header><h1>{$this->title}</h1></header>"; }
}

?>