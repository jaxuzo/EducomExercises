<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="config.css">
</head>
<body>

<?php

$page = $_GET['page'] ?? 'home';

// bepaal titel afhankelijk van pagina
switch ($page) {
    case 'about':
        $title = "Over Mij";
        break;
    case 'contact':
        $title = "Contact";
        break;
    default:
        $title = "Welkom";
}

include 'header.php';
include 'menu.php';
include "pages/$page.php";
include 'footer.php';

showHeader($title);
showMenu();
if ($page === 'home') {
    showHome();
} elseif ($page === 'about') {
    showAbout();
} elseif ($page === 'contact') {
    include 'submit.php';
    showContactForm();
}
showFooter()

?>

</body>
</html>