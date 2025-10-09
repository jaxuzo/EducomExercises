<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="config.css">
</head>
<body>

<?php

session_start();

$page = $_GET['page'] ?? 'home';

if (!isset($_SESSION['user']) && !in_array($page, ['login', 'register'])) {
    $page = 'landing';
}

// bepaal titel afhankelijk van pagina
switch ($page) {
    case 'about':
        $title = "Over Mij";
        break;
    case 'contact':
        $title = "Contact";
        break;
    case 'login':
        $title = "Inloggen";
        break;
    default:
        $title = "Welkom";
}

include 'header.php';
include 'menu.php';
include "pages/$page.php";
include 'footer.php';

showHeader($title);
showMenu($page);
if ($page === 'home') {
    showHome();
} elseif ($page === 'about') {
    showAbout();
} elseif ($page === 'contact') {
    include 'submit.php';
    showContactForm();
} elseif ($page === 'login') {
    showLogin($emailErr = 'testerror', $wwErr = '');
} elseif ($page === 'landing') {
    showLanding();
} else {
    echo "<div class='main'>Pagina niet gevonden</div>";
}

showFooter()



?>

</body>
</html>