<?php
// Passe un contrat : toute class qui implémente cette interface devra ne retourner que un objet PDO
namespace Pokemon\Interfaces;

interface Database
{
    public function getMySqlPDO(): \PDO;
}

