<?php
require_once ROOT . 'Models/FormModel.php';
require_once ROOT . 'Controllers/Validators/FormValidator.php';
require_once ROOT . 'config.php';

class Controller
{
    private $request;
    private $response;
    protected Database $db;
    protected UserSession $session;

    public function __construct(Database $db, UserSession $session){
        $this->db = $db;
        $this->session = $session;
    }

    public function handleRequest()
    {
        $this->getRequest();
        $this->validateRequest();
        $this->showResponse();
    }

    private function getRequest(): void
    {
        $posted = ($_SERVER['REQUEST_METHOD'] === 'POST'); // true als er een form is ingediend

        if ($posted) {
            $page = $_POST['page'] ?? 'home';
        } else {
            $page = $_GET['page'] ?? 'home';
        }
        $this->request =
            [
                'posted' => $posted, // associatief array met true of false van een post request
                'page' => $page
            ];
    }

    private function validateRequest()
    {
        //Voor nu nog even aanroepen hier omdat ik validateRequest wil testen. En daarvoor getRequest nodig heb. Normaal wordt alles in handleRequest gedaan.
        $this->response['page'] = $this->request['page'];
        
        if ($this->request['posted']) {
            echo 'Dit is een POST request <br>';
            // Als er een Post request is, is er altijd een Form validatie
            // Haal de data op van de Form die correspondeert met pagina waar request vandaan komt
            $field_data = new FormModel($this->request['page']);
            $field_names = $field_data->getFieldData();

            //Maak de validator aan aan de hand van de form metadata en valideer de Post waarden. Dit wordt intern gedaan want POST values zijn globaal
            $form_validator = new FormValidator($field_names);


            if ($form_validator->validate()) { //Alle checks zijn goed en de POST is goedgekeurd
                
                $values = $form_validator->getValues();

                switch($this->request['page']){
                    case 'contact':

                        echo 'Alles lijkt te kloppen!<br>';
                        $this->response['page'] = 'bedanktcontact';
                    
                        break;
                    
                    case 'login':

                        require_once ROOT.'Models/UserModel.php';

                        $user_model = new UserModel($this->db);
                        $user = $user_model->checkLogin($values['email'],$values['password']);

                        if ($user === false){
                            // Als user niet bestaat 
                            echo 'Login is niet goedgekeurd!<br>';
                            $this->response['errors']['email'] = $user_model->getLastError();
                        }

                        else{
                            $this->session->login($user);
                            $this->response['page'] = 'home';
                        }

                        break;

                    case 'register':

                        require_once ROOT.'Models/UserModel.php';

                        $user_model = new UserModel($this->db);
                        $user = $user_model->checkRegister($values['email'], $values['password'], $values['password2']);
                        if($user === false){
                            $this->response['errors']['email'] = $user_model->getLastError();
                        }
                        else{
                            $user = $user_model->registerUser($values['email'], $values['password']);
                            $this->session->login($user);
                            $this->response['page'] = 'home';
                        }
                        break;

                    default:
                        $this->response['page'] = 'home';
                }
            } else {
                echo 'Er is iets niet goed met je POST request!!<br>';
                $this->response['errors'] = $form_validator->getErrors();
                $this->response['values'] = $form_validator->getValues();
            }

            switch ($this->request['page']) {
                case 'contact':
                    //Nog iets pagina afhankelijks in de afhandeling
                }

        } else {
            echo 'Dit is een GET request <br>';
            switch ($this->request['page']) {
                    case 'logout':
                        $this->session->logout();
                        $this->response['page'] = 'home';
                    default:
                        // Alle get requests laten meteen de gevraagde pagina zien
                        $this->response['page'] = $this->request['page'];
            }
        }
    }

    private function showResponse()
    {
        require_once ROOT . 'Views/PageView.php';
        $page_view = new PageView($this->response['page'],$this->db, $this->response['errors'] ?? [], $this->response['values'] ?? []);
        $page_view->render();
    }
}
