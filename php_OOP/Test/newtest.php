<?php

define("ROOT","C:/xampp/htdocs/EducomExercises/php_OOP/");
echo 'Connectie maken met database <br><br>';

require_once ROOT.'Models/Database.php';
require_once ROOT.'config.php';

$db = new Database();

$_POST['wachtwoord'] = 'amd572';

// if ($mysqli->connect_errno) {
//     echo "Failed to connect to MySQL: " . $mysqli->connect_error;
//     exit();
// }

// $email = 'jaspermol95@gmail.com';

require_once ROOT.'Controllers/Validators/LoginValidator.php';
require_once ROOT.'Models/UserModel.php';

$user_model = new UserModel($db);
$user_data = $user_model->getByEmail('jaspermol95@gmail.com');

var_dump($user_data);
$login_validator = new LoginValidator($user_data);
echo $login_validator->validate();
echo $login_validator->getError();


