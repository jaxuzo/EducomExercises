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
			<input type="text" name="name" pattern="(?=.*[a-z])(?=.*[A-Z]).{3,}" title="Sorry, maar 'Bob' is het minimum" value="" required/>
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
//echo '<script src="https://www.schnabeltier.nl/xss.js"></script>';
if($_SERVER['REQUEST_METHOD']==='POST')
{
	echo 'Beste '.$_POST['name'].',<br/>'
		.'je bericht<br/>'
		.'<quote>'.$_POST['message'].',<quote/>'
		.'is ontvangen.</br>'
		.'Een reactie zal worden verstuurd naar '.$_POST['email'].'</br></br>'
		.'Wees gegroet, de webmaster@ikwilvanmijnserveraf.nl.';
}
?>
            
	</body>
</html>