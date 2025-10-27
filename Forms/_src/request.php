<?php
function getRequest() : array
{
    $posted = $_SERVER['REQUEST_METHOD']==='POST';
    return [
        'posted' => $posted,
        'page' 	 => strtolower(getRequestVar($posted, 'page', 'contact'))	
    ];
}

function getRequestVar(bool $from_post, string $varname, string $default) : string
{
    $result = filter_input(
            $from_post ? INPUT_POST : INPUT_GET,
            $varname,
            FILTER_SANITIZE_FULL_SPECIAL_CHARS
    );
    return (is_null($result)||$result===false) ? $default : $result;
}

