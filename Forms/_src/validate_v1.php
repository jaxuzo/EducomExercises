<?php
function checkFields(array $fields) : array
{
    $result = [
            'ok' => true
    ];	
    foreach (array_keys($fields) as $field_name)
    {
        $check = checkField($field_name);
        if ($check['ok'])
        {
            $result[$field_name] = $check['value'];
        }	
        else
        {
            $result['ok'] = false;
            $result[$field_name.'_err'] = $check['error'];
        }			
    }
    return $result;
}

function checkField(string $field_name) : array
{
    $result = [
        'ok' 	=> false
    ];
// Veld aanwezig?	
    if (isset($_POST[$field_name]))
    {
// W3 schools voorbeeld van filtering, zie php:filter_var functie voor beter alternatief
/*			
        $value = $_POST[$field_name];
        $value = trim($value); 
        $value = stripslashes($value); 
        $value = htmlspecialchars($value); 
*/
	$value 	= filter_input(INPUT_POST,$field_name,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		
// Veld leeg na filteren ?		
        if (empty($value))
        {
            $result['error'] = $field_name.' is empty.';
        }
        else
        {
            $result['ok'] = true;
            $result['value'] = $value;
        }	
    }
    else
    {
        $result['error'] = $field_name.' not found.';
    }
    return $result;
}

