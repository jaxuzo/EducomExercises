<?php

define("ROOT","C:/xampp/htdocs/EducomExercises/php_OOP/");

require_once ROOT.'Controllers/Controller.php';
require_once ROOT.'config.php';
require_once ROOT.'Models/Database.php';
require_once ROOT.'Controllers/UserSession.php';

$session = new UserSession();

$db= new Database();

$controller = new Controller($db, $session);
$controller->handleRequest();

?>