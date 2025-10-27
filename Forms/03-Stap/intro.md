# Formulier opnieuw tonen na foutieve input.
  
  Wanneer de validatie van het geposte formulier niet ok is, dan het formulier 
  opnieuw tonen, maar met
  
  - voor velden met een juiste geposte waarde deze waarde al ingevuld in het veld
  - voor velden met een foutieve waarde geen waarde ingevuld, maar foutmelding bij het veld
  
  Hiervoor moet aan showForm dus het POST-resultaat zoals samengesteld in checkField
  kunnen worden meegegeven.

  Kunnen worden meegegeven, daar dit enkel gebeurt wanneer het formulier opnieuw getoond wordt na een POST

  Hiervoor voegen we aan `showForm` een extra parameter toe met een default waarde.	
  Zie [Default argument values](https://www.php.net/manual/en/functions.arguments.php).
  
  In code, file [../_src/form_v2.php](../_src/form_v2.php) :
```php 
function showForm(string $action, string $method, array $fields, string $submit_caption, array $post_result = []) : void
{
	openForm($action, $method);
	showFields($fields, $post_result);
	closeForm($submit_caption);
}
``` 
## Values en errors tonen.
  `showForm` kan dus nu worden aangeroepen met **4 OF 5 parameters**,
  en `showForm` geeft dan of een lege array mee aan `showFields` wanneer de 5e parameter niet is meegegeven, 
  of de aan hem meegegeven waarde voor de 5e parameter (`$post_result`)
  
  `showFields` controleert vervolgens of er een VALUE en/of een ERROR in dat `$post_result`
  aanwezig is voor het betreffende veld die meegegeven moet worden aan `showField`.
  
  de waardes voor VALUE en ERROR zetten we mbv een [Ternary operator](https://www.geeksforgeeks.org/php-ternary-operator/).
  
  In code, file [../_src/form_v2.php](../_src/form_v2.php) :
```php
function showFields(array $fields, array $post_result) : void
{
	foreach ($fields as $name => $type)
	{
		$value = array_key_exists($name, $post_result) ? $post_result[$name] : '';
		$error = array_key_exists($name.'_err', $post_result) ? $post_result[$name.'_err'] : '';
		showField(
			field_name  : $name, 
			field_type  : $type, 
			field_value : $value, 
			field_error : $error
		);
	}
}

function showField(string $field_name, string $field_type, string $field_value, string $field_error) : void
{
	echo '		<label for="'.$field_name.'">'.$field_name.'</label>'.PHP_EOL;
	switch ($field_type)
	{
		case "textarea" :
			echo '		<textarea name="'.$field_name.'">'.$field_value.'</textarea>'.PHP_EOL;
			break;
		default :	
			echo '		<input type="'.$field_type.'" name="'.$field_name.'" value="'.$field_value.'"/>'.PHP_EOL;
			break;
	}
// Is error gevuld, dan tonen!	
	if ($field_error)
	{
		echo '		<span class="input_error">'.$field_error.'</span>'.PHP_EOL;
	}
	echo '<br />'.PHP_EOL;
}
``` 
## Test code
Nu kunnen we deze code testen.
Voor de leesbaarheid aanroep met [named parameters](https://stitcher.io/blog/php-8-named-arguments) :

Test, in file [index.php](/essentials/forms/03-Stap/index.php)
```php
$fields_to_show = [
	// Field Name :     //Field Type :
	'name' 			=> 'text',
	'email' 		=> 'email',
	'message' 		=> 'textarea'
];
include '../_src/form_v2.php';

if ($_SERVER['REQUEST_METHOD']==='POST')
{
	include '../_src/validate_v1.php';
	$post_result = checkFields($fields_to_show);
	if ($post_result['ok'])
	{	
		echo '<pre>';
		print_r($post_result);
		echo '</pre>';
	}
	else
	{
		showForm(
			action 			: 'index.php', 
			method 			: 'POST', 
			fields 			: $fields_to_show, 
			submit_caption 	: 'Send',
			post_result 	: $post_result
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
```


	
