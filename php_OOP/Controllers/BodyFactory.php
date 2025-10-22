<?php

require_once ROOT.'Views/Body/BaseBody.php';

class BodyFactory
{

    public function createBody(string $page, array $errors, array $values): BaseBody
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
            default:
                require_once ROOT.'Views/Body/HomeBody.php';
                return new HomeBody($page);
            }
    }
}

?>