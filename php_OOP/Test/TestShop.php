<?php

define("ROOT","C:/xampp/htdocs/EducomExercises/php_OOP/");

require_once ROOT.'config.php';
require_once ROOT.'Models/ShopModel.php';
require_once ROOT.'Models/Database.php';
require_once ROOT.'Controllers/UserSession.php';
require_once ROOT.'Views/ShopItem.php';
require_once ROOT.'Views/Body/ShopBody.php';

$db = new Database();
$_SESSION['user_id'] = 1;
// $shop_model = new ShopModel($db);

// $result = $shop_model->getShopItems();
// foreach($result as $product){
// $shop_item = new ShopItem($product);
// $shop_item->render();
// }

$shop_body = new ShopBody($db);
$shop_body->render();

