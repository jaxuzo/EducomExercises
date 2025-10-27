#Validatie

## Een eenvoudig contactformulier

Lek als een mandje, staat toe dat er heel wat verkeerde en/of lege user-input kan worden gepost.

```html
<form action="xss.php" method="POST" >
	<label for="name">name</label>
	<input type="text" name="name" value=""/>
	<br />
	<label for="email">email</label>
	<input type="email" name="email" value=""/>
	<br />
	<label for="message">message</label>
	<textarea name="message"></textarea>
	<br />
	<button type="submit" value="submit">Send</button>
</form>
```

## Een eenvoudig contactformulier met wat restricties

Iets minder lek, want er kan enkel gepost worden wanneer aan de volgende voorwaarden is voldaan:

1. Name moet minimaal 3 tekens lang zijn, en er moeten hoofdletters en kleine letters worden gebruikt.
2. Email moet een email adres zijn (xxx@yyy.zzz)
3. Message moet minimaal 20 tekens lang zijn

```html
<form action="xss.php" method="POST" >
	<label for="name">name</label>
	<input type="text" name="name" pattern="(?=.*[a-z])(?=.*[A-Z]).{3,}" title="'Sorry, but Bob is the minimum" value="" required/>
	<br />
	<label for="email">email</label>
	<input type="email" name="email" value="" required/>
	<br />
	<label for="message">message</label>
	<textarea name="message" minlength="20"></textarea>
	<br />
	<button type="submit" value="submit">Send</button>
</form>
```

## Waarom nog steeds lek?

### Reden 1, je vervelende buurjongetje...

Hij bouwt op zijn zonderkamertje een html-pagina met daarin een formulier dat als **action** jou *domein+script* heeft, 
draait dat op zijn *localhost* en gaat een avondje stoeien met wat mogelijk minder leuke user-input.

Probeer onderstaand voorbeeld met post naar **https://www.schnabeltier.nl/xsp.php** maar eens uit:

```html
<!DOCTYPE html>
<html lang="en-US">
    <head>
		<title>Cross Domain Post Test</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <h1>Cross Domain Post Test</h1>
		<form action="https://www.schnabeltier.nl/xsp.php" method="POST" >
			<label for="name">name</label><br/>
			<input type="text" name="name" value=""/>
			<br />
			<label for="email">email</label><br/>
			<input type="email" name="email" value=""/>
			<br />
			<label for="message">message</label><br/>
			<textarea name="message"></textarea>
			<br />
			<button type="submit" value="submit">Send To Schnabeltier.nl</button>
		</form>
    </body>
</html>
```

Je kunt er dus **NOOIT** vanuitgaan dat een **POST** uit **JE EIGEN** formulier komt!!!

### Reden 2, de nog kwaadwillender boze buitenwereld.

Zonder een behoorlijk stuk javascript om te input te controleren op 
SQL-injecties of Cross Site Scripting is er nog steeds een hele hoop ongewenste input mogelijk.

	
Probeer onderstaand php-script maar eens uit met :

```
nette poging 1:
name:**Rosie** 
email:**wholelotta@rosie.com**
message:**Please call me asap at 42-39-56**

minder nette poging 2:
name:**Sclipt In Vu Ging** 
email:**be@jing.ch**
message:**<script src="https://www.schnabeltier.nl/xss.js"></script>**
```


*xss.php:*
```php
<!DOCTYPE html>
<html lang="nl-NL">
	<head>
		<title>TEST XSS</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
		<form action="xss.php" method="POST" >
			<label for="name">name</label>
			<input type="text" name="name" pattern="(?=.*[a-z])(?=.*[A-Z]).{3,}" title="'Sorry, maar Bob is het minimum" value="" required/>
			<br />
			<label for="email">email</label>
			<input type="email" name="email" value="" required/>
			<br />
			<label for="message">message</label>
			<textarea name="message" minlength="20"></textarea>
			<br />
			<button type="submit" value="submit">Send</button>
		</form>
<?php
if($_SERVER['REQUEST_METHOD']==='POST')
{
	echo 'Beste '.$_POST['name'].',<br/>'
		.'je bericht<br/>'
		.'<quote>'.$_POST['message'].',<quote/>'
		.'is ontvangen.</br>'
		.'Een reactie zal worden verstuurd naar '.$_POST['email'].'</br></br>'
		.'Wees gegroet, webmaster@ikwilvanmijnserveraf.nl.';
}
?>
	</body>
</html>
```

# Never trust a user - Server-side validatie 

Vertrouw op Alah, maar bind je kameel vast.


## SANITIZE of VALIDATE ?

## Numerieke waardes (nummers)

Zet de userinput (tekst) om in een nummer.
Lukt dit niet, dan zat er rommel in de user-input.
Lukt dit wel, controleer of het nummer in de gewenste range zit,

## Alfanumerieke waardes (tekst)

Enkele input-types hebben een veilige INPUT-FILTER die je in filter_var kunt gebruiken,
zonder dat je eerst de input moet escapen.

De volgende filters falen gebruik van < > ' of " in de user-input, hetgeen conversie van deze 
karacters naar html-entities overbidig maakt :

FILTER_VALID_EMAIL 

 



# File uploads
tbc...
