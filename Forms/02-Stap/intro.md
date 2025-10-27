 
# Een gepost html formulier valideren.

Wanneer het formulier verstuurd wordt naar de server moeten we per input-field

1. controleren of het input_field aanwezig is in het request 
	(`$_POST` bij method="**POST**", `$_GET` bij method="**GET**")
2. wanneer aanwezig geposte waarde filteren, anders foutmelding
3. wanneer niet leeg na filteren de waarde bewaren, anders foutmelding

## Valideer 1 veld
Per veld willen we 2 dingen weten, 
- veld *ok* en *geposte, gefilterde waarde*,
of
-  veld *niet ok* en *foutmelding*

In code, file [../_src/validate_v1.php](../_src/validate_v1.php), uitgaande van method='POST' in formulier:
```php
function checkField(string $field_name) : array
{
	$result = [
		'ok' 	=> false
	];
// Veld aanwezig?	
	if (isset($_POST[$field_name]))
	{
// W3 schools voorbeeld van filtering, zie php:filter_var functie voor beter alternatief		
		$value = $_POST[$field_name];
		$value = trim($value); 
		$value = stripslashes($value); 
		$value = htmlspecialchars($value); 
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
``` 
## Valideer alle velden
Deze functie moet dus worden aangeroepen voor **alle velden** die in het formulier   
zitten, en ahv het resultaat per veld een eindconclusie (form-ok of niet) getrokken worden.

**Alle velden** in het formulier is gedeclareerd in de in stap 1 genoemde *key-value array*   
die gebruikt werd om de velden in het formulier te tonen!

> 📝 De informatie die gebruikt is om het formulier te tonen is dus ook de informatie die nodig is om thet formulier te valideren!
```php
function checkFields(array $fields) : array
{
	$result = [
		'ok' => true
	];	
//n.b. voor checkField hebben we enkel de fieldName nodig...	
	foreach (array_keys($fields) as $field_name)
	{
		$check = checkField($field_name);
		if ($check['ok'])
		{
//Bij ok, value opslaan in resultaat			
			$result[$field_name] = $check['value'];
		}	
		else
		{
//Is een veld niet ok, dan is eindresultaat ook niet ok 			
			$result['ok'] = false;
//Bij niet ok, error voor deze field_name opslaan in eindresultaat			
			$result[$field_name.'_err'] = $check['error'];
		}			
	}
	return $result;
}
``` 
## Test code
Nu kunnen we deze code testen.
Voor de leesbaarheid aanroep met [named parameters](https://stitcher.io/blog/php-8-named-arguments) :

Test, in file [index.php](/essentials/forms/02-Stap/index.php)
```php
$fields_to_show = [
	// Field Name :     //Field Type :
	'name' 			=> 'text',
	'email' 		=> 'email',
	'message' 		=> 'textarea'
];

if ($_SERVER['REQUEST_METHOD']==='POST')
{
	include '../_src/validate_v1.php';
	$post_result = checkFields($fields_to_show);
	echo '<pre>';
	print_r($post_result);
	echo '</pre>';
}		

include '../_src/form_v1.php';
showForm(
	action : 'index.php', 
	method : 'POST', 
	fields : $fields_to_show, 
	submit_caption : 'Send'
);
```

