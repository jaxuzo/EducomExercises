<?php
function checkFields(array $fields) : array
{
    $result = [
            'ok' => true
    ];	
    foreach ($fields as $field_name => $field_info)
    {
        $check = checkField($field_name, $field_info);
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

function checkField(string $field_name, array $field_info) : array
{
    $result = [
        'ok' 	=> false
    ];
    $filter = array_key_exists('filter',$field_info)
            ? $field_info['filter']
            : FILTER_SANITIZE_FULL_SPECIAL_CHARS;
    $value = filter_input(INPUT_POST,$field_name,$filter, FILTER_NULL_ON_FAILURE);
    if (is_null($value))
    {
        $result['error'] = $field_name.' is invalid.';
        return $result;
    }    
    if ($value===false)
    {
        $result['error'] = $field_name.' not found.';
        return $result;
    }    
    $value = trim($value);
// Veld leeg na filteren ?		
    if (empty($value))
    {
        $result['error'] = $field_name.' is empty.';
        return $result;
    }
    $result['ok'] = true;
    $result['value'] = $value;
    return $result;
}
