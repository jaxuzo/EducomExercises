<?php
function showForm(string $page, string $action, string $method, array $fields, string $submit_caption, array $post_result = []) : void
{
	openForm($page, $action, $method);
	showFields($fields, $post_result);
	closeForm($submit_caption);
}

function openForm(string $page, string $action, string $method) : void
{
    echo '<form action="'.$action.'" method="'.$method.'" >'.PHP_EOL
		.'	<input type="hidden" name="page" value="'.$page.'" />'.PHP_EOL;
}

function showFields(array $fields, array $post_result) : void
{
    foreach ($fields as $name => $info)
    {
        showField(
            field_name  : $name, 
            field_info  : $info, 
            field_value : array_key_exists($name, $post_result) ? $post_result[$name] : '', 
            field_error : array_key_exists($name.'_err', $post_result) ? $post_result[$name.'_err'] : ''
        );
    }
}

function showField(string $field_name, array $field_info, string $field_value, string $field_error) : void
{
    echo '      <label for="'.$field_name.'">'.$field_info['label'].'</label>'.PHP_EOL;
    switch ($field_info['type'])
    {
        case "textarea" :
            echo '      <textarea name="'.$field_name.'">'.$field_value.'</textarea>'.PHP_EOL;
            break;
        default :	
            echo '      <input type="'.$field_info['type'].'" name="'.$field_name.'" value="'.$field_value.'"/>'.PHP_EOL;
            break;
    }
    if ($field_error)
    {
        echo '      <span class="input_error">'.$field_error.'</span>'.PHP_EOL;
    }
    echo '<br />'.PHP_EOL;
}

function closeForm(string $submit_caption) : void
{
    echo '  <button type="submit" value="submit">'.$submit_caption.'</button>'.PHP_EOL
        .'</form>'.PHP_EOL;
}

