<?php
include '..\_src\testpage.php';
include '..\_src\form_v1.php';

openTestPage('FORMTEST 1','','Formulier tonen mbv field info array');

$fields_to_show = [
	// Field Name :     //Field Type :
	'name' 			=> 'text',
	'email' 		=> 'email',
	'message' 		=> 'textarea'
];

showForm(
	action : 'index.php', 
	method : 'POST', 
	fields : $fields_to_show, 
	submit_caption : 'Send'
);

closeTestPage('');