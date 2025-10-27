<?php
function openTestPage(string $title,string $css, string $descr='') : void
{
    echo <<<EOD
<!DOCTYPE html>
<html lang="en-US">
    <head>
    <title>$title</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
EOD;    
    if ($css)
    {
        echo '<link rel="stylesheet" href="'.$css.'">'.PHP_EOL;
    }    
    echo <<<EOD
    </head>
    <body>
        <h1>$title</h1>
EOD;            
    if ($descr)
    {
        echo '<h2>'.$descr.'</h2>'.PHP_EOL;
    }    
}        

function closeTestPage(string $js) : void
{
    if ($js)
    {
        echo '<script src="'.$js.'"></script>'.PHP_EOL;
    }    
    echo <<<EOD
    </body>
</html>
EOD;    
}   

function dump(string $var_name, mixed $var_value, bool $as_code = false) : void
{
    echo '<h3>'.$var_name.'</h3><'.($as_code?'code':'pre').'>';
    is_array($var_value) ? print_r($var_value) : var_dump($var_value);
    echo '</'.($as_code?'code':'pre').'>';
}        