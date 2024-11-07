<?php

namespace Pokemon\Factory;

use Pokemon\Interfaces\Database;

class DatabaseFactory implements Database
{
    private string $host;
    private string $dbName;
    private string $userName;
    private string $password;
    private string $port;

    public function __construct(string $host = "db", string $port = "3306", string $dbName = "db", string $userName = "root", string $password = "root")
    {
        $this->host = $host;
        $this->port = $port;
        $this->dbName = $dbName;
        $this->userName = $userName;
        $this->password = $password;
    }

    // You can keep the following methods if needed for PDO connections
    public function getMySqlPDO(): \PDO
    {
        return new \PDO("mysql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->dbName, $this->userName, $this->password);
    }
}
