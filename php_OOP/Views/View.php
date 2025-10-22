<?php

abstract class View {
    protected string $content;

    public function __construct(string $content) {
        $this->content = $content;
    }

    abstract public function render(): void;
}

?>