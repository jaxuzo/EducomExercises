<?php

Class MenuModel {

    private bool $loggedIn;

    public function __construct(){
        //Checkt puur of de user ingelogd is
        $this->loggedIn = isset($_SESSION['user']);
    }

    public function getMenuItems() : array{
        if(!$this -> loggedIn){
            $items = [
                'home' => ['label' => 'Home'],
                'about' => ['label' => 'About'],
                'contact' => ['label' => 'Contact'],
                'login' => ['label' => 'Login'],
                'registreren' => ['label' => 'Registreer'],
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