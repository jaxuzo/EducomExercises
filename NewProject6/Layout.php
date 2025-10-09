
<?php
function showHeader($title)
{
    echo "<div class = 'header'> 
            <h1>" . $title . "</h1>
          </div>";
}

function showMenu() {
    echo '<ul class="menu">';
    if (isset($_SESSION['user'])) {
        echo '
        <li><a href="?page=home">Home</a></li>
        <li><a href="?page=about">About</a></li>
        <li><a href="?page=contact">Contact</a></li>
        <li><a href="?page=logout">Uitloggen</a></li>
        ';
    } else {
        echo '
        <li><a href="?page=login">Login</a></li>
        <li><a href="?page=register">Register</a></li>
        <li><a href="?page=contact">Contact</a></li>
        ';
    }
    echo '</ul>';
}

function showAbout()
{
    echo "<div class='main'>
    <p>Autumn breeze whispers,<br>
    Golden leaves dance on the ground,<br>
    Silent sky turns gray. </p>
    </div>";
}

function showHome()
{
    echo '<div class="main">
        Welkom op mijn homepage! Wat leuk dat je meer over mij te weten wilt komen, navigeer naar de About pagina om meer over mij te weten te komen.
    </div>';
}

function showFooter()
 {
     echo "<footer>&copy;&nbsp;".date("Y")." Jasper's Website. All rights reserved. </footer>";
 }

function showContactForm(array $ErrorMessage = []) {

    $nameError = $ErrorMessage['name'] ?? '';
    $emailError = $ErrorMessage['email'] ?? '';
    $messageError = $ErrorMessage['message'] ?? '';
    
    echo '
    <div class="main">
      <h2>Contactformulier</h2>
      <p><span class="error">* required field</span></p>
      <form action="'. htmlspecialchars($_SERVER["PHP_SELF"]).'" method="post">

          <input type="hidden" name="page" value="contact">'. //fix dat bij redirect ook de juist pagina wordt opgeslagen, staat nu hardcoded in

          '<label for="name">Naam:</label>
          <input type="text" id="name" name="name" value ="'.($_POST['name'] ?? '').'">
          <span class="error">* ' . $nameError . '</span><br>

          <label for="email">Email:</label>
          <input type="email" id="email" name="email" value ="'.($_POST['email'] ?? '').'">
          <span class="error">* ' . $emailError. '</span><br>

          <label for="bericht">Bericht:</label>
          <textarea id="bericht" name="bericht" rows="4" > '.($_POST['bericht'] ?? '').'</textarea>
          <span class="error">* ' . $messageError . '</span><br>

          <button type="submit">Verstuur</button>
      </form>
    </div>';
}

function showLoginForm(array $ErrorMessage = [])
{
    $emailErr = $ErrorMessage['email'] ?? '';
    $wwErr = $ErrorMessage['wachtwoord'] ?? '';

    echo '<div class="main">
    <form action="'. htmlspecialchars($_SERVER["PHP_SELF"]).'" method="post">

        <input type="hidden" name="page" value="login">

        E-mail: <input type="text" name="email" value = "'.($_POST['email'] ?? '').'">
        <span class="error">*'. $emailErr . '</span><br>

        Wachtwoord: <input type="text" name="wachtwoord" value = "'.($_POST['wachtwoord'] ?? '').'">
        <span class="error">*'. $wwErr . '</span><br>
        <input type="submit" value="Login">
      </form>
    </div>';
}

function showRegisterForm(array $ErrorMessage = [])
{   
    $emailErr = $ErrorMessage['email'] ?? '';
    $wwErr = $ErrorMessage['wachtwoord'] ?? '';
    $nameErr = $ErrorMessage['name'] ?? '';

    echo '<div class="main">
      <form action="'. htmlspecialchars($_SERVER["PHP_SELF"]).'" method="post">

        <input type="hidden" name="page" value="register">

        E-mail: <input type="text" name="email" value ="'.($_POST['email'] ?? '').'">
        <span class="error">*'. $emailErr . '</span><br>

        Naam: <input type="text" name="name" value ="'.($_POST['name'] ?? '').'">
        <span class="error">*'. $nameErr. '</span><br>

        Wachtwoord: <input type="text" name="wachtwoord" value ="'.($_POST['wachtwoord'] ?? '').'">
        <span class="error">*'. $wwErr . '</span><br>

        Herhaal wachtwoord: <input type="text" name="wachtwoord2" value ="'.($_POST['wachtwoord2'] ?? '').'">
        <span class="error">*</span><br>

        <input type="submit" value="Registreer">
      </form>
    </div>';
}