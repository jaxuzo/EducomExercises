<?php

class RequestHandler{

    public function getValue(string $name) : ?string
    {
        return $_GET[$name] ?? null;
    }

    public function isPost() : bool
    {
        return $_SERVER['REQUEST_METHOD']==='POST';
    }
}

?>