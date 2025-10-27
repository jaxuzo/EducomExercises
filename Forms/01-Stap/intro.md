---
sidebar_position: 100
title: PHP Forms en validatie
tags: 
- PHP
- FORM 
- Validatie
---

import ReactMarkdown from 'react-markdown'

# HTML-Formulieren tonen mbv PHP

### Een html formulier tonen.

* Een Form heeft een action en een method
* Een Form bevat 1 of meer input-velden (input, select, textarea ect).
* Een Form heeft een submit-button met een caption ("Send", "Login", ect)

Het tonen van een form kunnen je definieren met het volgende PSD :


```sh
Show Form
--------------------------------
| Open Form         (Begin)    | 
--------------------------------
| Voor alle velden  (Iteratie) |
|   ---------------------------- 
|   | Show Field               |						
--------------------------------	
| Close Form        (End)      |
--------------------------------
```
In code :
```php 
function showForm()
{
	openForm();
	showFields();
	closeForm();
}
```
## Het HTML-formulier

Een HTML form-tag heeft [meerdere attributen](https://www.w3schools.com/html/html_forms_attributes.asp) die gezet kunnen worden.   
Ook is het handig om de *tekst op de submit-button* per formulier te kunnen zetten.   
Niet onbelangrijk is ook *welke velden* er in het formulier moeten worden getoond.

Om `showForm` herbruikbaar te maken voor meerdere situaties moeten 
we wat informatie meegeven :

* de action
* de method 
* de te tonen velden
* de submit-button caption

In code:
```php 
function showForm(string $action, string $method, array $fields, string $submit_caption) : void
{
	openForm($action, $method);
	showFields($fields);
	closeForm($submit_caption);
}
```

## De te tonen velden
Een *minimale informatie* die nodig is om een [input-field](https://www.w3schools.com/html/html_form_input_types.asp) te tonen  
is een **naam** en een **type**.  
Alle te tonen velden samen zou dus kunnen worden gedefinieerd als [associatieve array](https://www.w3schools.com/php/php_arrays_associative.asp)   
met **naam** als *key*, en **type** als *value*.

Voor een eenvoudig contact-formulier zou dit er zo uitzien :

```php 
$fields_to_show = [
//  Name           Type
	'name'		=> 'text',
	'email' 	=> 'email',
	'message' 	=> 'textarea'
];
```
## function showForm
In code, file [../_src/form_v1.php](../_src/form_v1.php)
```php 
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
	echo '		<button type="submit" value="submit">'.$submit_caption.'</button>'.PHP_EOL
		.'	</form>'.PHP_EOL;
}
```
## function showField
In `showField` houden we (voor nu) rekening met de volgende inputtypes :
1. `<input type="X"` waarbij "X" is 'text', 'email', 'password' etc
2. `<textarea></textarea>`  

> 📝 n.b. In latere stappen gaan we meer input-types implementeren.

```php 
function showField(string $field_name, string $field_type) : void
{
	echo '		<label for="'.$field_name.'">'.$field_name.'</label>'.PHP_EOL;
	switch ($field_type)
	{
		case "textarea" :
			echo '		<textarea name="'.$field_name.'"></textarea>'.PHP_EOL;
			break;
		default :	
			echo '		<input type="'.$field_type.'" name="'.$field_name.'" />'.PHP_EOL;
			break;
	}
	echo '<br />'.PHP_EOL;
}
```
## Test code
Nu kunnen we deze code testen.
Voor de leesbaarheid aanroep met [named parameters](https://stitcher.io/blog/php-8-named-arguments) :

Test, in file [index.php](/essentials/forms/01-Stap/index.php)
```php 
include '../_src/form_v1.php';

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
```











