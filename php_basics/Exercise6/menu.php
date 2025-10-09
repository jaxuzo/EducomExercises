<?php
function showMenu() {
    echo '<ul class="menu">';
    if (!isset($_SESSION['user'])) {
        echo '
        <li><a href="?page=home">Home</a></li>
        <li><a href="?page=about">About</a></li>
        <li><a href="?page=contact">Contact</a></li>
        <li><a href="?page=logout">Uitloggen</a></li>
        ';
    } else {
    //     echo '
    //     <li><a href="?page=login">Login</a></li>
    //     <li><a href="?page=register">Register</a></li>
    //     ';
    // }
    echo '</ul>';
}
}
?>