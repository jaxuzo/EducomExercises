<!DOCTYPE html>
<html lang="en-US">
    <head>
		<title>Cross Domain Post</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <h1>Cross Domain Post</h1>
<?php
	echo '<h3><i>'.$_SERVER['HTTP_HOST']
		.'</i> received a <i>'.$_SERVER['REQUEST_METHOD']
		.'</i>-request from <i>'
		.$_SERVER['REMOTE_ADDR'].'</i></h3>';
	
	echo '<h4>GET-parameters</h4><pre>';
	foreach ($_GET as $key => $value)
	{
		echo $key.' => ['.htmlspecialchars($value).']<br/>';
	}
	echo '</pre>';
	if (count($_POST)>0)
	{
		echo '<h4>POST-parameters</h4><pre>';
		foreach ($_POST as $key => $value)
		{
			echo $key.' => ['.htmlspecialchars($value).']<br/>';
		}
		echo '</pre>';
	}
?>
    </body>
</html>

