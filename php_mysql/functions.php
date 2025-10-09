 <?php
include 'database.php';
include 'Validation.php';
include 'layout.php';

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

        $result = $request; // getoond == gevraagd, zie uitleg Request-Response overview....
        if ($request['posted']) // er is een post request
        {      
            
            if(isset($_POST['order'])){
                addToCart($_POST);
            }

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
                        $result['page'] = 'bedanktLogin'; // door naar bedankt pagina
                        $_SESSION['user_name'] = $_POST['name']; //
                    }
                    else {
                        $result['ErrorMessage'] = $validation;
                    }
                    break;

                case 'register':
                    $validation = validateRegisterForm($_POST);
                    if (empty($validation)) {
                        $result['page'] = 'bedanktRegister'; // door naar bedankt pagina
                        // Sla de gebruiker op in users.txt
                        $conn = connectToDatabase();
                        writeToDatabase($conn, $_POST);
                    } else {
                        $result['ErrorMessage'] = $validation;
                    }
                    break;

                case 'shoppingcart':
                    if(isset($_POST['check_out'])){
                        echo $_POST['check_out'];

                        $validation = validateOrder($_POST);

                        if (!empty($validation)) {
                            // order is niet valide
                            $result['ErrorMessage'] = $validation;
                            var_dump($result['ErrorMessage']);
                            break;
                        }
                        echo 'Order is valide';
                        saveOrderToDatabase($_POST);
                        $_SESSION['cart'] = []; // leegt de winkelwagen na het plaatsen van de
                        $result['page'] = 'bevestiging'; // door naar bedankt pagina
                    }
                    break;

            }
        } else {//get_request wordt hier afgehandeld
            if(!isset($_SESSION['user_id']) && !in_array($request['page'] , ['login','register', 'home','shop','itempage','contact']) ){  
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
                echo "welkom " . $_SESSION['user_name'] . ", je bent succesvol ingelogd.";
                break;
            case 'logout':
                $title = "Uitloggen";
                showHeader($title);
                showMenu();
                echo "U bent succesvol uitgelogd.";
                break;
            case 'shop':
                $title = "Shop";
                showHeader($title);
                showMenu();
                showShop();
                break;
            case 'itempage':
                $title = "Productpagina";
                showHeader($title);
                showMenu();
                showItemPage();
                break;
            case 'shoppingcart':
                $title = 'Winkelwagen';
                showHeader($title);
                showMenu();
                showCartPage();
                break;
            case 'bevestiging':
                $title = "Bevestiging";
                showHeader($title);
                showMenu();
                showOrderConfirmation();
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