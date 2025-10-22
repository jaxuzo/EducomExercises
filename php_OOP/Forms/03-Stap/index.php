<?php
include '..\_src\testpage.php';
openTestPage('FORMTEST 3','','Formulier tonen, valideren en opnieuw tonen');

$fields_to_show = [
    'name' 	=> 'text',
    'email' 	=> 'email',
    'message' 	=> 'textarea'
];

include '..\_src\form_v2.php';

if ($_SERVER['REQUEST_METHOD']==='POST')
{
    include '..\_src\validate_v1.php';
    $post_result = checkFields($fields_to_show);
    
    if ($post_result['ok'])
    {	
        dump('Gevalideerd PostResult voor verdere verwerking', $post_result);
    }
    else
    {
        showForm(
            action : 'index.php', 
            method : 'POST', 
            fields : $fields_to_show, 
            submit_caption : 'Send',
            post_result : $post_result
        );
    }		
}		
else
{
    showForm(
        action : 'index.php', 
        method : 'POST', 
        fields : $fields_to_show, 
        submit_caption : 'Send'
    );
}   

closeTestPage('');




