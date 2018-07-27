<?php

class databaseConnection 
{
    // Datubāzes pieslēgšanās dati.
    private $user;
    private $password;
    private $host;
    private $database;

    public function __construct()
    {
        $this->user = 'draugiemgroup';
        $this->password = 'securepassword';
        $this->host = 'localhost';
        $this->database = 'draugiemgroup';
    }

    // Funkcija, kas nodrošina pielēgumu datubāzei.
    public function connect()
    {
        $connection = new mysqli($this->host, $this->user, $this->password, $this->database);
        $connection->set_charset("utf8");
        return $connection;
    }
}

?>
