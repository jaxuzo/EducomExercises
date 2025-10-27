<?php

define("ROOT","C:/xampp/htdocs/EducomExercises/php_OOP/");

require_once ROOT.'Controllers/Validators/FormValidator.php';
require_once ROOT.'Models/FormModel.php';
require_once ROOT.'Controllers/Controller.php';


$_SERVER['REQUEST_METHOD'] = 'POST';
$_POST['page'] = 'login';
// Goede request
$_POST = ['name'=>'Jasper Mol', 'email'=>'jaspermol95@gmail.com', 'comment' => 'test']; 

// // Lege comment
// $_POST = ['email'=>'jaspermol95@gmail.com', 'comment' => '', 'bankid' => 'test'];

// Lege naam
// $_POST = ['name'=>'', 'email'=>'jaspermol95@gmail.com', 'comment' => ''];

// // Verkeerde Email
// $_POST = ['name'=>'Jasper Mol', 'email'=>'jaspermol95gmail.com', 'comment' => 'test'];

// $field_data = new FormModel('contact');
// $field_names = $field_data->getFieldData();


// $form_validator = new FormValidator($field_names);
// echo '<pre>';
// if($form_validator->validate()){
//     print_r($form_validator -> getValues());
// }
// else{
//     print_r($form_validator -> getValues());
//     print_r($form_validator -> getErrors());
// }
// echo '</pre>';

$controller = new Controller();
$controller->handleRequest();

// $response = ['page' => 'contact'];
// $response['errors'] = ['name' => 'Naam is niet aanwezig'];

// echo'<pre>';
// var_dump($response);
// echo'</pre>';