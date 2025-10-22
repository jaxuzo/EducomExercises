<?php
require_once ROOT.'Models/FormModel.php';
require_once ROOT.'Controllers/Validators/FormValidator.php';

class Controller
{
    private $request;
    private $response;

    public function handleRequest()
    {
        $_POST['page'] ='contact'; // VERWIJDEREN LATER
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

        $this->response = $this->request; // getoond == gevraagd
        $page = $this->request['page'];
        if ($this->request['posted']) {
            switch ($this->request['page']) {
                case 'contact':

                    $field_data = new FormModel($page);
                    $field_names = $field_data->getFieldData();

                    $form_validator = new FormValidator($field_names);
                    $form_validator->validate();

                    if ($form_validator->validate()) { //Alle checks zijn goed en de POST is goedgekeurd
                        echo 'Alles lijkt te kloppen!<br>';
                        $this->response['page']='bedanktcontact';
                        // verwijzen naar de bedanktpagina
                    } else {
                        echo 'Er is iets niet goed met je POST request!!<br>';
                         $this->response['errors'] = $form_validator->getErrors();
                         $this->response['values'] = $form_validator->getValues();
                        // Wat er dus moet gebeuren is dat deze pagina geladen moet worden in showResponse, niet hier want anders gaat mijn logica boos worden :)
                    }
            }
        } else {
            switch ($this->request['page']) {
                    // get request afhandelingen die meerdere antwoorden kunnen genereren....
                    // zie uitleg Request-Response overview
            }
        }
    }

    private function showResponse()
    {
                require_once ROOT.'Views/PageView.php';
                $page_view = new PageView($this->response['page'], $this->response['errors'] ?? [], $this->response['values'] ?? []);
                $page_view->render();
    }
}
