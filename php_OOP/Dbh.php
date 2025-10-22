<?php

class Database {
    
    private string $servername;
    private string $username;
    private string $password;
    private string $dbname;
    protected ?\mysqli $conn = null;

    //Als je een nieuw object aanmaakt, wordt de constructor automatisch aangeroepen en dus ookm automatisch de connect functie
    public function __construct(
        string $servername,
        string $username,
        string $password,
        string $dbname,
        string $charset = 'utf8mb4'
    ) {
        $this->servername = $servername;
        $this->username   = $username;
        $this->password   = $password;
        $this->dbname     = $dbname;
        $this->connect($charset);
    }
    
    protected function connect(string $charset = 'utf8mb4'): \mysqli {

        if ($this->conn !== null) {
            return $this->conn;
        }
        //Maakt een nieuwe mysqli object aan
        $this->conn = new \mysqli($this->servername, $this->username, $this->password, $this->dbname);
        
        //Stelt welke type characterset er gebruikt gaat worden
        $this->conn->set_charset($charset);
        
        return $this->conn;
    }


    protected function disconnect(): void {
        if ($this->conn !== null) {
            $this->conn->close();
            $this->conn = null;
        }
    }

    //Als het object verwijderd wordt, wordt de verbinding automatisch gesloten
    protected function __destruct()
    {
        $this->disconnect();
    }


}


?>