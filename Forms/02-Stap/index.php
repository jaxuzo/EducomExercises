<?php
include '..\_src\testpage.php';
openTestPage('FORMTEST 2','','Formulier tonen en valideren ahv field-info array');

$fields_to_show = [
    'name' 			=> 'text',
    'email' 		=> 'email',
    'message' 		=> 'textarea'
];

if ($_SERVER['REQUEST_METHOD']==='POST')
{
    include '..\_src\validate_v1.php';
    $post_result = checkFields($fields_to_show);
    dump('PostResult', $post_result);
}		

include '..\_src\form_v1.php';
showForm(
    action : 'index.php', 
    method : 'POST', 
    fields : $fields_to_show, 
    submit_caption : 'Send'
);

closeTestPage('');