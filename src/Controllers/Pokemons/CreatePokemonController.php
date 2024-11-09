<?php
namespace Pokemon\Controllers\Pokemons;

use Exception;
use Pokemon\Factory\PDOFactory;
use Pokemon\Manager\Pokemons\PokemonManager;
use Pokemon\Manager\Pokemons\CreatePokemonManager;

class CreatePokemonController {

    private PDOFactory $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function createNewPokemon()
    {      
        if(empty($_POST['pokemon-name'])) {
            header("Location: /create-pokemon?error=pokemonNameNotFilled");
            exit();
        }
        
        $pokemonName = htmlspecialchars($_POST['pokemon-name']) ?? "";
        $pokemonImage = htmlspecialchars($_POST['pokemon-image']) ?? "";
        $pokemonType = htmlspecialchars($_POST['pokemon-type']) ?? "";
        $pokemonManager = new PokemonManager($this->conn);
        $createPokemonManager = new CreatePokemonManager($this->conn);
        $pokemonNameAlreadySet = $pokemonManager->getPokemonByName($pokemonName);
     
        if($pokemonNameAlreadySet) {
            header("Location: /create-pokemon?error=alreadyNameCreated");
            exit();
        }
        
       
        
        $pokemonNewId = $createPokemonManager->insertNewPokemon($pokemonImage, $pokemonName, $pokemonType, 'png');  

        header("Location: /create-pokemon?success=pokemonCreated&id=" . $pokemonNewId);
        exit();    
    } 
}