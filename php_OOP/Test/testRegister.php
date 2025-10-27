<?php 

define("ROOT","C:/xampp/htdocs/EducomExercises/php_OOP/");

require_once ROOT.'config.php';
require_once ROOT.'Models/UserModel.php';
require_once ROOT.'Models/Database.php';
require_once ROOT.'Controllers/UserSession.php';

$session = new UserSession();

$db = new Database();
$user_model = new UserModel($db);

$login = ['email' => 'jaspermol95@gmail.com', 'password' => 'amd572'];

$register = ['email' => 'jaspermol95@gmail.com', 'password' => 'amd572', 'password2' => 'amd572'];

$user = $user_model->checkLogin($login['email'], $login['password']);

$session -> login($user);
echo $_SESSION['user_id'];
// $user = $user_model->checkRegister($register['email'], $register['password'], $register['password2']);
// $error = $user_model -> getLastError();
// var_dump($user); // Moet user teruggeven
// echo $error;
// echo '<br>';

