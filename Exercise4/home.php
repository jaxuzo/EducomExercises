<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" href="config.css">
</head>

<body>


    <?php
 function showFooter()
 {
     echo "<footer>&copy;&nbsp;".date("Y")."Jasper's Website. All rights reserved. </footer>";
 }

    function showHeader()
    {
        echo '<div class="header">
      Mijn Website
    </div>';
    }

    function showMenu()
    {
        echo '<ul class="menu">
      <li><a href="home.html">Home</a></li>
      <li><a href="about.html">About</a></li>
      <li><a href="contact.html">Contact</a></li>
    </ul>';
    }

    function showMain()
    {
        echo '<div class="main">
        Welkom op mijn homepage! Wat leuk dat je meer over mij te weten wilt komen, navigeer dan naar de About pagina.
    </div>';
    }

    showHeader();
    showMain();
    showMenu();
    showFooter();

    ?>
</body>

</html>