<!DOCTYPE html>
<html>
<body>
<pre>

<?php
$cars = array("Volvo", "BMW", "Toyota"); 

echo "My favorite car brands used to be:\n";
foreach ($cars as $x) {
    echo "-" .  $x . "\n";
}
$cars[0] = "Mitshubishi";
$cars[1] = "Mazda";
$cars[2] = "Ford";

echo "\nBut now my favorite car brands are:\n";
foreach ($cars as $x) {
    echo "-" . $x . "\n";
}

$favcar = array("brand" => "Ford", "model" => "Mustang", "year" => 1969);
echo "\nAnd my favorite car is a " . $favcar["year"] . " " . $favcar["brand"] . " " . $favcar["model"] . ".\n";
?>


</pre>
</body>
</html>