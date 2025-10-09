<?php

$email = $ww = "";
$emailErr = $wwErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["email"])) {
    $emailErr = "email is verplicht";
  }
  else {
    $email = $_POST["email"];
  }
  
  if (empty($_POST["wachtwoord"])) {
    $wwErr = "Wachtwoord is verplicht";
  } else {
    $ww = $_POST["wachtwoord"];
    }
}

function showLogin($emailErr = '', $wwErr = '')
{
    echo "<div class='main'>
      <form action='/home.php' method='post'>

        E-mail: <input type='text' name='email' required>
        <span class='error'>*". $emailErr . "</span><br>

        Wachtwoord: <input type='text' name='wachtwoord' required>
        <span class='error'>*". $wwErr . "</span><br>
        <input type='submit', value='Login'>
      </form>
    </div>";
}

?>