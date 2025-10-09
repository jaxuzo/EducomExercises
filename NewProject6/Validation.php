<?php

// function which validates all the fields and checks for errors
function validateContactForm($data) {
    $errors = [];

    // Validate name
    if (empty($data['name'])) {
        $errors['name'] = "Name is required.";
    }
    elseif (!preg_match("/^[a-zA-Z-' ]*$/", $data['name'])) {
        $errors['name'] = "Only letters and white space allowed in name.";
    }

    // Validate email
    if (empty($data['email'])) {
        $errors['email'] = "Email is required.";
    } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    }

    // Validate message
    if (empty($data['bericht'])) {
        $errors['bericht'] = "Message is required.";
    }

    return $errors;
}

function validateRegisterForm($data) {
    $errors = [];
    var_dump($data);
    // Validate email
    if (empty($data['email'])) {
        $errors['email'] = "Email is required.";
    } elseif (checkExistingEmail($data['email'])) {
        $errors['email'] = "Email already exists.";
    } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    }

    // Validate password
    if (empty($data['wachtwoord'])) {
        $errors['wachtwoord'] = "Password is required.";
    } elseif ($data['wachtwoord'] !== ($data['wachtwoord2'] ?? '')) {
        $errors['wachtwoord'] = "Passwords do not match.";
    } elseif (strlen($data['wachtwoord']) < 6) {
        $errors['wachtwoord'] = "Password must be at least 6 characters long.";
    // } elseif (!preg_match("/[A-Z]/", $data['wachtwoord'])) {
    //     $errors['wachtwoord'] = "Password must contain at least one uppercase letter.";
    // } elseif (!preg_match("/[a-z]/", $data['wachtwoord'])) {
    //     $errors['wachtwoord'] = "Password must contain at least one lowercase letter.";
    // } elseif (!preg_match("/[0-9]/", $data['wachtwoord'])) {
    //     $errors['wachtwoord'] = "Password must contain at least one number.";
    // } elseif (!preg_match("/[\W]/", $data['wachtwoord'])) {
    //     $errors['wachtwoord'] = "Password must contain at least one special character.";
    // } 
    } elseif (preg_match("/\s/", $data['wachtwoord'])) {
        $errors['wachtwoord'] = "Password must not contain spaces.";
    }

    // Validate name
    if (empty($data['name'])) {
        $errors['name'] = "Name is required.";
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $data['name'])) {
        $errors['name'] = "Only letters and white space allowed in name.";
    }

    var_dump($errors);
    return $errors;
}

function checkExistingEmail($email) {
    $lines = file('users.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {        
        list($storedEmail, $storedName, $storedPassword) = explode('|', $line);

        if ($email === $storedEmail){
            return true; // User exists
        }
    }
    return false;   
}

function validateLoginForm($data) {
    // Validate email and password

    if (empty($data['email']) || empty($data['wachtwoord'])) {
        return ['email' => 'Email and password are required.'];
    }
    
    $lines = file('users.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {        
        list($storedEmail, $storedName, $storedPassword) = explode('|', $line);

        if ($data['email'] === $storedEmail){
            if ($data['wachtwoord'] === $storedPassword) {
                $_POST['name'] = $storedName; // Set the name for session use
                return []; // Valid login
            } else {
                return ['wachtwoord' => 'Incorrect password.'];
            }
        }
    }
    return ['email' => 'User not found'];  // User not found, but do not reveal this information     
}