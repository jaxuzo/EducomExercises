<?php
function showForm(string $action, string $method, array $fields, string $submit_caption) : void
{
    openForm($action, $method);
    showFields($fields);
    closeForm($submit_caption);
}

function openForm(string $action, string $method) : void
{
    echo '<form action="'.$action.'" method="'.$method.'" >'.PHP_EOL;
}

function showFields(array $fields) : void
{
    foreach ($fields as $name => $type)
    {
        showField($name, $type);
    }
}

function closeForm(string $submit_caption) : void
{
    echo '  <button type="submit" value="submit">'.$submit_caption.'</button>'.PHP_EOL
        .'</form>'.PHP_EOL;
}

function showField(string $field_name, string $field_type) : void
{
    echo '      <label for="'.$field_name.'">'.$field_name.'</label>'.PHP_EOL;
    switch ($field_type)
    {
        case "textarea" :
            echo '      <textarea name="'.$field_name.'"></textarea>'.PHP_EOL;
            break;
        default :	
            echo '      <input type="'.$field_type.'" name="'.$field_name.'" />'.PHP_EOL;
            break;
    }
    echo '<br />'.PHP_EOL;
}

