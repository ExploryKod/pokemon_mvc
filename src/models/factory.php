<?php

class Factory {
    
    private string $servername;
    private string $username;
    private string $password;
    private string $dbname;

    public function connect() {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    }


}