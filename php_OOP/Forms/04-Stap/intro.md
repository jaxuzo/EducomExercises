# Een applicatie met meerdere formulieren.
  
  Welk formulier wordt er gevraagd of gepost?   
  Dit bepalen we ahv de parameter '**page**', 
  meegegeven als *url-parameter* in een GET-request 
  en meegegeven als een *hidden field* in een POST-request.
  
  In code, [../_src/request.php](../_src/request.php)
```php 
function getRequest() : array
{
	$posted = $_SERVER['REQUEST_METHOD']==='POST';
	return [
		'posted' => $posted,
		'page' 	 => strtolower(getRequestVar($posted, 'page', 'contact'))	
	];
}

function getRequestVar(bool $from_post, string $varname, string $default) : string
{
	$result = filter_input(
		$from_post ? INPUT_POST : INPUT_GET,
		$varname,
		FILTER_SANITIZE_FULL_SPECIAL_CHARS
	);
	return (is_null($result)||$result===false) ? $default : $result;
}
``` 
## Welke velden horen er bij dit formulier?
  Hiervoor maken we een nieuw bestand, `data.php` met daarin een   
  functie die voor de meegegeven *page* een *key-value array* retourneert,   
  met *veld-naam* als **key** en *veld-type* als **value**.
  
> 📝 n.b.  de nu hard-coded arrays kun je later vervangen door het resultaat van een database query...

  In code, [../_src/data.php](../_src/data.php)
```php 
function getFieldsByPage(string $page) : array
{
	switch ($page)
	{
		case 'login':
			return [
				'email' 		=> 'email',
				'password' 		=> 'password'
			];
		case 'register':
			return [
				'name' 			=> 'text',
				'email' 		=> 'email',
				'password' 		=> 'password'
				'repeatpassword'=> 'password'
			];
		case 'contact':
		default: 
			return [
				'name' 			=> 'text',
				'email' 		=> 'email',
				'message' 		=> 'textarea'
			];
	}
}	

``` 
## Keuze-menu tonen
  Nu hebben we een menu nodig in de pagina om de verschillende formulieren 
  mee te kiezen.    
  Hiervoor maken we een nieuw bestand, `menu.php` met daarin de functies
  om een html menu te tonen.

```sh  
Show Menu
--------------------------------
| Open Menu         (Begin)    | 
--------------------------------
| Voor alle items (Iteratie)   |
|   ---------------------------- 
|   | Show MenuItem            |						
--------------------------------	
| Close Menu        (End)      |
--------------------------------
 ``` 
  De te tonen menu-items worden meegegeven als *key-value array*, 
  met '*page*' als **key** en '*title*' als	**value**.
  
  In code, [../_src/menu.php](../_src/menu.php)
```php
function showMenu(array $menu_items) : void
{
	echo '<nav><ul class="menu">'.PHP_EOL;
	foreach ($menu_items as $page => $title)
	{
		showMenuItem($page, $title);
	}
	echo '</ul><nav>'.PHP_EOL;
}

function showMenuItem(string $page_value, string $item_title) : void	
{
	echo '<li class="menu_item"><a href="?page='.$page_value.'">'.$item_title.'</a></li>'.PHP_EOL;
}
``` 
## Menu-items ophalen
  In [../_src/data.php](../_src/data.php) maken we een nieuwe functie die de menu-items retourneert:
```php
function getMenuItems() : array
{
	return [
		'contact' => 'Contact me!',
		'login'	  => 'Login',
		'register'=> 'Register'		
	
	];
}
``` 
## Formulier aanpassen
  Als laatste moeten we ervoorzorgen dat bij een POST-request de page-waarde 
  wordt meegegeven in de $_POST.
	
  Hiervoor maken we een kleine uitbreiding in `showForm` :
1. page-waarde meegeven als parameter
2. page-waarde tonen als **value** in een *hidden field* **page**

  In code, [../_src/form_v3.php](../_src/form_v3.php)
```php 
function showForm(string $page, string $action, string $method, array $fields, string $submit_caption, array $post_result = []) : void
{
	openForm($page, $action, $method);
	showFields($fields, $post_result);
	closeForm($submit_caption);
}

function openForm(string $page, string $action, string $method) : void
{
    echo '<form action="'.$action.'" method="'.$method.'" >'.PHP_EOL
		.'	<input type="hidden" name="page" value="'.$page.'" />'.PHP_EOL;
}

``` 
## Test code
Nu kunnen we deze code testen.
Voor de leesbaarheid aanroep met 'named parameters' :

Test, in file [index.php](/essentials/forms/04-Stap/index.php)

> 📝 n.b. extra php-file `testpage.php` bevat enkele handige functies voor kleine test-scriptjes... 
```php 
include '..\_src\testpage.php';
include '..\_src\request.php';
include '..\_src\data.php';
include '..\_src\menu.php';
include '..\_src\form_v3.php';

openTestPage('FORMTEST 4','','Formulieren kiezen, tonen, valideren en opnieuw tonen');

showMenu(getMenuItems());

$request = getRequest();

$fields = getFieldsByPage($request['page']);


if ($request['posted'])
{
    include '..\_src\validate_v1.php';
    $post_result = checkFields($fields);
    
    if ($post_result['ok'])
    {	
        dump('Gevalideerd PostResult van ['.$request['page'].'] voor verdere verwerking', $post_result);
    }
    else
    {
        showForm(
            page   : $request['page'],   
            action : 'index.php', 
            method : 'POST', 
            fields : $fields, 
            submit_caption : 'Send',
            post_result : $post_result
        );
    }		
}		
else
{
    showForm(
        page   : $request['page'],   
        action : 'index.php', 
        method : 'POST', 
        fields : $fields, 
        submit_caption : 'Send'
    );
}   

closeTestPage('');



	