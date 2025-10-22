<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="config.css">
</head>
<body>

<?php

define("ROOT","C:/xampp/htdocs/EducomExercises/php_OOP/");

require_once ROOT.'Controllers/Controller.php'; 

session_start();
$_SERVER['REQUEST_METHOD'] = 'POST';
$_POST['page'] = 'contact';
$controller = new Controller();
$controller->handleRequest();

?>