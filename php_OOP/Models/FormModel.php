<?php
//Klasse die bepaalt welke data voor het formuleer wordt meegegeven afhankelijk van op welke pagina je zit.
class FormModel{

    private string $page;

    public function __construct($page){
        $this->page = $page;
    }

    public function getFieldData():array {
        switch ($this->page){
            case 'contact':
                return 
                    [
                    'name' => ['type' => 'text', 'label'=>'Naam'],
                    'email' => ['type' => 'email', 'label' => 'Email'],
                    'comment' => [ 'type' => 'textarea', 'label' => 'Comment']
                    ];
            // case 'login':
            //     return [1,1];
            // case 'register':
            //     return [2,1];
            default:
                return [];
        }
    }

    //Makkelijke arrays maken voor initialisatie van mijn validatie zoals in testscript staat : 

    public function getFormName(){
        switch($this->page){
            case 'contact':
                return 'Contactformulier';
            case 'shop':
                return 'Shop';
        }
    }
    

    public function getSubmitCaption(){
        switch($this->page){
            case 'contact':
                return 'Indienen';
            case 'shop':
                return 'Toevoegen';
            default:
                return 'Submit';
        }
    }

    public function getPage(): string
    {
        return $this->page;
    }

}


?>