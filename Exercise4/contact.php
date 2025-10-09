<!DOCTYPE html>
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
<link rel="stylesheet" href="config.css">
</head>
<body>

<?php
// define variables and set to empty values
$name = $email = $bericht = "";
$nameErr = $emailErr = $berichtErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["naam"])) {
    $nameErr = "Naam is verplicht";
  } else {
    $name = test_input($_POST["naam"]);
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is verplicht";
  } else {
    $email = test_input($_POST["email"]);
    }
  
    
  if (empty($_POST["bericht"])) {
    $berichtErr = "Bericht is verplicht";
  } else {
    $bericht = test_input($_POST["bericht"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function showFooter()
 {
     echo "<footer>&copy;&nbsp;".date("Y")." Jasper's Website. All rights reserved. </footer>";
 }

function showHeader(){
    echo '<div class="header">
      Contact
    </div>';
  }

function showMenu(){
    echo '<ul class="menu">
      <li><a href="home.html">Home</a></li>
      <li><a href="about.html">About</a></li>
      <li><a href="contact.html">Contact</a></li>
    </ul>';
  }


function showContactForm($nameErr = '', $emailErr = '', $berichtErr = '') {
    echo '
<div class="main">
    <h2>Contactformulier</h2>
    <p><span class="error">* required field</span></p>
    <form action="submit.php" method="post">
        <label for="naam">Naam:</label>
        <input type="text" id="naam" name="naam" required>
        <span class="error">*'. $nameErr . '</span><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <span class="error">*'. $emailErr . '</span><br>

        <label for="bericht">Bericht:</label>
        <textarea id="bericht" name="bericht" rows="4" required></textarea>
        <span class="error">*'. $berichtErr . '</span><br>

        <button type="submit">Verstuur</button>
    </form>
  </div>';
  }

showHeader();
showMenu();
showContactForm($nameErr, $emailErr, $berichtErr);
showFooter();


?>
</body>
</html>