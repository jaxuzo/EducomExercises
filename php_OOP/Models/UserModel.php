<?php

class UserModel
{
    protected Database $db;
    protected string $last_error;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function checkLogin(string $email, string $password): array | false
    {
        $this->last_error = '';
        $user = $this->getUserByEmail($email);

        if (is_null($user)) {
            $this->last_error = 'Er is geen gebruiker met deze email';
            return false;
        }
        if ($user['password'] !== $password) {
            $this->last_error = 'Het wachtwoord is niet juist';
            return false;
        }
        return $user;
    }

    public function checkRegister(string $email, string $password, string $password2): array | false
    {
        $this->last_error = '';
        $user = $this->getUserByEmail($email);

        if (!is_null($user)) {
            $this->last_error = 'Gebruiker met deze email bestaat al';
            return false;
        }
        
        if ($password !== $password2){
            $this->last_error = 'Wachtwoorden komen niet overeen';
            return false;
        }
        
        return ['email' => $email, 'password'=> $password];
        
    }

    public function registerUser(string $email, string $password): array | false{
       
        $success = $this->db->writeToDB('users', ['email' => $email, 'password' => $password]);
        
        if (!$success) {
            $this->last_error = "Kon gebruiker niet opslaan in de database";
            return false;
        }
        $user = $this->getUserByEmail($email);

        return $user;
    }

    public function getLastError()
    {
        return $this->last_error;
    }

    protected function getUserByEmail(string $email): ?array
    {
        $sql = "SELECT * FROM users WHERE email = ?";
        $result = $this->db->query($sql, [$email]);
        // Dus of returned de eerst, of wordt null
        return $result[0] ?? null;
    }

    
}
