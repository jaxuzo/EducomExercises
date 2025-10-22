<?php
include '..\_src\testpage.php';
openTestPage('FORMTEST 2','','Formulier tonen en valideren ahv field-info array');

$fields_to_show = [
    'name' 			=> 'text',
    'email' 		=> 'email',
    'message' 		=> 'textarea'
];

$post_result = [];
$posted = ($_SERVER['REQUEST_METHOD']==='POST');

if ($posted)
{
    include '..\_src\validate_v1.php';
    $post_result = checkFields($fields_to_show);
}	
else
{
	
}	

include '..\_src\form_v2.php';
showForm(
    action : 'xss.php', 
    method : 'POST', 
    fields : $fields_to_show, 
    submit_caption : 'Send',
	post_result : $post_result
);

if ($posted)
{
	echo '<h2>Geposte waardes ongevalideerd gebruiken in je pagina:</h2>';	
	echo 'Beste '.$_POST['name'].',<br/>'
	.'je bericht<br/>'
	.'<quote>'.$_POST['message'].',<quote/><br/>'
	.'is ontvangen.</br>'
	.'Een reactie zal worden verstuurd naar '.$_POST['email'].'</br>';
}

closeTestPage('');