<?php

Class MenuModel {

    private bool $loggedIn;

    public function __construct(){
        //Checkt puur of de user ingelogd is
        $this->loggedIn = isset($_SESSION['user_id']);
    }

    public function getMenuItems() : array{
        if(!$this -> loggedIn){
            $items = [
                'home' => ['label' => 'Home'],
                'about' => ['label' => 'About'],
                'contact' => ['label' => 'Contact'],
                'shop' => ['label' => 'Shop'],
                'login' => ['label' => 'Login'],
                'register' => ['label' => 'Registreer'],
            ];
        }
        else{
            $items = [
                'home' => ['label' => 'Home'],
                'about' => ['label' => 'About'],
                'contact' => ['label' => 'Contact'],
                'shop' => ['label' => 'Shop'],
                'cart' => ['label' => 'Cart'],
                'logout' => ['label' => 'Logout'],
            ];
        }
        return $items;
    }
}

?>