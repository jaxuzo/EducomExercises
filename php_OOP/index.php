<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="config.css">
</head>
<body>

<?php
require 'Views/Menu.php';

$Test2 = new Menu(['home' => 'Huis']);
$TestMenu = new Menu();
echo $Test2->render();
?>