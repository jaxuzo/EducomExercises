<?php
include '..\_src\testpage.php';

function testInput(string $test_title, array $user_input, int $filter, mixed $options) : void
{
	echo '<h3>Test '.$test_title.'</h3>'
	    .'<table><tr><th>Input<th><th>Result</th></tr>';
	foreach ($user_input as $value)	
	{
		echo '<tr><td>'.htmlspecialchars($value).'</td><td>'
			.(filter_var($value, $filter, $options)?'OK':'FAIL')
			.'</td></tr>';
	}
	echo '</table>';
}


openTestPage('FILTER TEST','','Filter tests');






closeTestPage('');