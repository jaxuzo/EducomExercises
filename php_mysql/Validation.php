<?php

// function which validates all the fields and checks for errors
function validateContactForm($data)
{
    $errors = [];

    // Validate name
    if (empty($data['name'])) {
        $errors['name'] = "Name is required.";
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $data['name'])) {
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

function validateRegisterForm($data)
{
    $errors = [];
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

function checkExistingEmail($email)
{

    $conn = connectToDatabase();

    $query = "SELECT * FROM users WHERE email = '$email'";

    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        closeDatabaseConnection($conn);
        return true; // Email exists
    } else {
        closeDatabaseConnection($conn);
        return false; // Email does not exist
    }
}

function validateLoginForm($data)
{
    // Validate email and password

    if (empty($data['email']) || empty($data['wachtwoord'])) {
        return ['email' => 'Email and password are required.'];
    }

    $conn = connectToDatabase();

    $query = "SELECT * FROM users WHERE email = '$data[email]'";

    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        if ($data['wachtwoord'] === $row['password']) {
            $_POST['name'] = $row['name'];
            $_SESSION['user_id'] = $row['id'];
            return []; // Valid login
        } else {
            return ['wachtwoord' => 'Incorrect password.'];
        }
    } else {
        return ['email' => 'User not found'];
    }

    closeDatabaseConnection($conn);
}

function validateOrder()
{
    // Check of cart neit leeg is
    // Check of elke item in cart non empty is
    // Check of user is ingelogd

    // check of cart niet leeg is
    if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart']) || count($_SESSION['cart']) === 0) {
        return ['cart' => 'Your cart is empty.'];
    }

    // check of erg geen lege items in de cart zijn
    foreach ($_SESSION['cart'] as $item) {
        if (empty($item['product_id']) || empty($item['quantity']) || $item['quantity'] <= 0) {
            return ['cart' => 'Invalid item in cart.'];
        }
    }

    // check of user is ingelogd
    if (!isset($_SESSION['user_id'])) {
        return ['user' => 'You must be logged in to place an order.'];
    }

    var_dump($_POST['datetime']);
    // check of datetime klopt
    if (empty($_POST['datetime']) || !preg_match("/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/", $_POST['datetime'])) {
        return ['datetime' => 'Invalid date and time.'];
    }
    return [];
}
