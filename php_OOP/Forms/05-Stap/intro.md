# Veld-informatie uitbreiden

Tot nu toe gebruiken we enkel een **naam** en een **type** om een veld te tonen.

Maar mooier zou zijn om wat meer informatie te kunnen gebruiken, om zo beter bruikbare formulieren te
kunnen bouwen.

Denk bij deze extra informatie bijvoorbeeld aan 
* De *tekst* die op het `label` wordt getoond
* Een *placeholder* voor niet ingevulde velden
* Een *default waarde* 

Om dit te kunnen implementeren is de tot nu toe gebruikte *key=naam => valye=type array* ontoereikend,   
we willen meer informatie aan een specifiek veld toewijzen.

```php 
$fields_to_show = [
// Field Name :        string Field Type :
	'name' 			=> 'text',
	'email' 		=> 'email',
	'message' 		=> 'textarea'
];
```

Hiervoor veranderen we de *value* die nu een *string* was en het **type** bevat in
een *associatieve array* die **meer informatie** kan bevatten.

```php 
$fields_to_show = [
// Field Name      array Field Info :
	'name' 			=> [
							'type'		=> 'text',
							'label'		=> 'Uw naam',
						],
	'email' 		=> [
							'type'		=> 'email',
							'label'		=> 'Uw email-adres',
						],
	'message' 		=> [
							'type'		=> 'textarea'
							'label'		=> 'Uw bericht',
						],
];
```

## showField aanpassen

De functie `showField` moet nu worden aangepast:
1. De parameter *string* `$field_type` wordt *array* `$field_info`
2. `$field_info['type']` en `$field_info['label']` moeten worden geimplementeerd in de functie.

Ook de functie `showFields` wordt aangepast op deze verandering.

In code, [../_src/form_v4a.php](../_src/form_v4a.php)
```php 
function showFields(array $fields, array $post_result) : void
{
    foreach ($fields as $name => $info) // was => $type
    {
        $value = array_key_exists($name, $post_result) ? $post_result[$name] : '';
        $error = array_key_exists($name.'_err', $post_result) ? $post_result[$name.'_err'] : '';
        showField(
            field_name  : $name, 
            field_info  : $info, // was field_type : $type
            field_value : $value, 
            field_error : $error
        );
    }
}

function showField(string $field_name, array $field_info, string $field_value, string $field_error) : void
{
// label en type zitten nu in array $field_info :
    echo '      <label for="'.$field_name.'">'.$field_info['label'].'</label>'.PHP_EOL;
    switch ($field_info['type'])
    {
        case "textarea" :
            echo '      <textarea name="'.$field_name.'">'.$field_value.'</textarea>'.PHP_EOL;
            break;
        default :	
            echo '      <input type="'.$field_type.'" name="'.$field_name.'" value="'.$field_value.'"/>'.PHP_EOL;
            break;
    }
    if ($field_error)
    {
        echo '      <span class="input_error">'.$field_error.'</span>'.PHP_EOL;
    }
    echo '<br />'.PHP_EOL;
}
```
## optionele informatie toevoegen

Veel HTML-inputfields hebben eigen, voor dat type specifieke attributen,
bij een &lt;input type="number"&gt; kun je bij voorbeeld aangeven van de minimale en maximale waarde mag zijn,  
alsook de stapgrootte waarmee deze waarde wordt verhoogd og verlaagd.

Ook een  &lt;textarea"&gt; heeft enkele handige attributen zoals cols en rows waarmee je de maximale regel-lengte en aantal regels
kunt beperken.

Ook dit soort specifieke, optionele kenmerken kun je opnemen in de $field_info-array:

```php 
$fields_to_show = [
// Field Name      array Field Info :
	'name' 			=> [
							'type'		=> 'text',
							'label'		=> 'Uw naam',
						],
	'email' 		=> [
							'type'		=> 'email',
							'label'		=> 'Uw email-adres',
						],
	'message' 		=> [
							'type'		=> 'textarea'
							'label'		=> 'Uw bericht',
							'rows'		=> 10, // nieuw specifiek en optineel
							'cols'		=> 80  // nieuw specifiek en optineel
						],
];
```

In code, [../_src/form_v4b.php](../_src/form_v4b.php) 
```php 
function showField(string $field_name, array $field_info, string $field_value, string $field_error) : void
{
// label en type zitten nu in array $field_info :
    echo '      <label for="'.$field_name.'">'.$field_info['label'].'</label>'.PHP_EOL;
    switch ($field_info['type'])
    {
        case "textarea" :
            $rows = isset($field_info['rows'])?$field_info['rows']:5;
            $cols = isset($field_info['cols'])?$field_info['cols']:120;
            echo '      <textarea name="'.$field_name.'" rows="'.$rows.'" cols="'.$cols.'">'.$field_value.'</textarea>'.PHP_EOL;
            break;
        default :	
            echo '      <input type="'.$field_type.'" name="'.$field_name.'" value="'.$field_value.'"/>'.PHP_EOL;
            break;
    }
    if ($field_error)
    {
        echo '      <span class="input_error">'.$field_error.'</span>'.PHP_EOL;
    }
    echo '<br />'.PHP_EOL;
}
```




## meerkeuze velden toevoegen
Nu we een mogelijkheid hebben om meer informatie over een veld te kunnen vastleggen en gebruiken  
kunnen we nu ook de wat complexere meerkeuze velden implementeren.

Denk hierbij aan bijvoorbeeld 
* het [&lt;select&gt;-element](https://developer.mozilla.org/en-US/docs/Web/HTML/Element/select) 
* of [radio-groups](https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input/radio)

## &lt;select&gt;-element implementeren