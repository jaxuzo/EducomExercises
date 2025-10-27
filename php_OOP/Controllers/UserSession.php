<?php

class UserSession{
    private ?int $user_id = null;
    private ?string $email = null;
    private bool $is_logged_in;

    public function __construct(){
        session_start();
        //als er een sessie al bestaat met een user, neem dan de waardes over
    }

    public function login(array $user): void {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
    }

    public function logout(): void {
        session_unset();
        session_destroy();
    }

    public function getUserId(): ?int {
        return $_SESSION['user_id'];
    }

    public function getEmail(): ?string {
        return $_SESSION['email'];
    }

    public function IsLoggedIn() : bool {
        if (isset($_SESSION['user_id'])){
            return false;
        }
        return true;
    }

}