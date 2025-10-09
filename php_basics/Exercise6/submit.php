<?php
function welcome(){
    echo 
    'Welkom '. $_POST["naam"].'<br>
    Jouw email-adres is: '. $_POST["email"].'<br>    
    Uw bericht is: '. $_POST["bericht"].'<br>';
}

welcome();

?>