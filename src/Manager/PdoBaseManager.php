<?php

namespace Pokemon\Manager;

use Pokemon\Interfaces\Database;

abstract class PdoBaseManager
{
    protected \PDO $pdo;

    public function __construct(Database $database)
    {
        $this->pdo = $database->getMySqlPDO();
    }
}
