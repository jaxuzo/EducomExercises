<?php
function showContactSubmit(){
    echo 
    'Bedankt voor het opnemen van contact. We zullen zo spoedig mogelijk bij uw terugkomem. <br>
    Hierbij een samenvatting van uw contactformulier <br><br>
    Jouw naam is: '. $_POST["name"].'<br>
    Jouw email-adres is: '. $_POST["email"].'<br>    
    Uw bericht is: '. $_POST["bericht"].'<br>';
}
?>