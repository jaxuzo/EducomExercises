 <?php

    function handleRequest()
    {   
        $request = getRequest();
        $response['ErrorMessage'] = [];
        $response = validateRequest($request);
        showResponse($response);
    }

    function getRequest(): array
    {
        $posted = ($_SERVER['REQUEST_METHOD'] === 'POST'); // true als er een form is ingediend

        if ($posted) {
            $page = $_POST['page'] ?? 'home';
        } else {
            $page = $_GET['page'] ?? 'home';
        }
        return
            [
                'posted' => $posted, // associatief array met true of false van een post request
                'page' => $page];
    }

    function validateRequest(array $request): array
    {
        include 'Validation.php';

        $result = $request; // getoond == gevraagd, zie uitleg Request-Response overview....
        if ($request['posted']) // er is een post request
        {
            switch ($request['page']) {
                case 'contact':
                    $validation = validateContactForm($_POST);
                    if (empty($validation)) {
                        $result['page'] = 'bedanktContact'; // door naar bedankt pagina
                    } else {
                        $result['ErrorMessage'] = $validation;
                    }
                    break;
                
                case 'login':
                    $validation = validateLoginForm($_POST);
                    if (empty($validation)) {
                        $result['page'] = 'bedanktLogin'; // door naar home pagina
                        $_SESSION['user'] = $_POST['name']; //
                        $result['ErrorMessage'] = $validation;
                    }
                    break;

                case 'register':
                    $validation = validateRegisterForm($_POST);
                    if (empty($validation)) {
                        $result['page'] = 'bedanktRegister'; // door naar bedankt pagina
                        // Sla de gebruiker op in users.txt
                        $line = $_POST['email'] . '|' . ($_POST['name']) . '|' . ($_POST['wachtwoord']) . PHP_EOL;
                        file_put_contents('users.txt', $line, FILE_APPEND | LOCK_EX);
                    } else {
                        $result['ErrorMessage'] = $validation;
                    }
                    break;

            }
        } else {//get_request wordt hier afgehandeld
            if(!isset($_SESSION['user']) && !in_array($request['page'] , ['login', 'register', 'home']) ){  
                $result['page'] = 'home';
            }
            else{
                switch ($request['page']) // er is een get request
                    {
                        case 'logout':
                            session_unset();
                            session_destroy();
                            break;
                    // get request afhandelingen die meerdere antwoorden kunnen genereren....
                    // zie uitleg Request-Response overview
                    }
                }
        }   
        return $result;
    }

    function showResponse($response)
    {   
        include 'layout.php';
        // toon de juiste pagina
        // var_dump($response);
        switch ($response['page']) {
            case 'about':
                $title = "Over Mij";
                showHeader($title);
                showMenu();
                showAbout();
                break;
            case 'contact':
                $title = "Contact";
                showHeader($title);
                showMenu();
                showContactForm($response['ErrorMessage'] ?? []);
                break;
            case 'login':
                $title = "Inloggen";
                showHeader($title);
                showMenu();
                showLoginForm($response['ErrorMessage'] ?? []);
                break;
            case 'register':
                $title = "Registreren";
                showHeader($title);
                showMenu();
                showRegisterForm($response['ErrorMessage'] ?? []);
                break;
            case 'bedanktContact':
                $title = "Bevestiging";
                showHeader($title);
                showMenu();
                include 'submit.php';
                showContactSubmit();
                break;
            case 'bedanktRegister':
                $title = "Bevestiging";
                showHeader($title);
                showMenu();
                echo "Bedankt voor je registratie. Je kunt nu inloggen.";
                break;
            case 'bedanktLogin':
                $title = "Bevestiging";
                showHeader($title);
                showMenu();
                echo "welkom " . $_SESSION['user'] . ", je bent succesvol ingelogd.";
                break;
            case 'logout':
                $title = "Uitloggen";
                showHeader($title);
                showMenu();
                echo "U bent succesvol uitgelogd.";
                break;
            default:
                $title = "Welkom";
                showHeader($title);
                showMenu();
                showHome();
        }
        // toon de footer
        showFooter();

    }


    // function getRequestVar(string $key, bool $frompost, $default = "", bool $asnumber = FALSE)
    // // Deze functie checkt of we in een post of get request zitten en haalt de waarde van de parameter page op
    // // Als de parameter niet bestaat, wordt de default waarde teruggegeven "Home", Hij kijkt ook afhankelijk van 
    // // de soort request en welke informatie hij moet zitten
    // {
    //     $filter = $asnumber ? FILTER_SANITIZE_NUMBER_FLOAT : FILTER_SANITIZE_STRING;
    //     $result = filter_input(($frompost ? INPUT_POST : INPUT_GET), $key, $filter);
    //     return ($result === FALSE) ? $default : $result;
    // }

    ?>