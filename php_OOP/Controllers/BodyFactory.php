<?php

require_once ROOT.'Views/Body/BaseBody.php';

class BodyFactory
{

    public function createBody(string $page, Database $db, array $errors, array $values): BaseBody
    {
        switch($page){
            case 'about':
                require_once ROOT.'Views/Body/AboutBody.php';
                return new AboutBody($page);
            case 'home':
                require_once ROOT.'Views/Body/HomeBody.php';
                return new HomeBody($page);
            case 'contact':
                require_once ROOT.'Views/Body/ContactBody.php';
                return new ContactBody($page, $errors, $values);
            case 'bedanktcontact':
                require_once ROOT.'Views/Body/BedanktContactBody.php';
                return new BedanktContactBody($page, $errors, $values);
            case 'login':
                require_once ROOT.'Views/Body/LoginBody.php';
                return new LoginBody($page, $errors, $values);
            case 'register':
                require_once ROOT.'Views/Body/RegisterBody.php';
                return new RegisterBody($page, $errors, $values);
            case 'shop':
                require_once ROOT.'Views/Body/ShopBody.php';
                return new ShopBody($db);
            case 'itempage':
                require_once ROOT.'Views/Body/ItemBody.php';
                return new ItemBody($db);
            default:
                require_once ROOT.'Views/Body/HomeBody.php';
                return new HomeBody($page);
            }
    }
}

?>