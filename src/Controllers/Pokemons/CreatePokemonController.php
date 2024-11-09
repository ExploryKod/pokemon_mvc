<?php
namespace Pokemon\Controllers\Pokemons;

use Exception;
use Pokemon\Factory\PDOFactory;
use Pokemon\Manager\Pokemons\PokemonManager;
use Pokemon\Manager\Pokemons\CreatePokemonManager;

class CreatePokemonController {

    private PokemonManager $pokemonManager;
    private CreatePokemonManager $createPokemonManager;

    public function __construct(PDOFactory $conn) {
        $this->pokemonManager = new PokemonManager($conn);
        $this->createPokemonManager = new CreatePokemonManager($conn);
    }

    public function createNewPokemon()
    {      
        if (empty($_POST['pokemon-name'])) {
            header("Location: /create-pokemon?error=pokemonNameNotFilled");
            exit();
        }

        if (empty($_POST['pokemon-type'])) {
            header("Location: /create-pokemon?error=pokemonTypeNotFilled");
            exit();
        }
    
        if (empty($_POST['pokemon-image'])) {
            header("Location: /create-pokemon?error=pokemonImageNotFilled");
            exit();
        }
        
        
        $pokemonName = htmlspecialchars(trim($_POST['pokemon-name']));
        $pokemonImage = htmlspecialchars(trim($_POST['pokemon-image']));
        $pokemonType = htmlspecialchars(trim($_POST['pokemon-type']));
        
        try {
          $pokemonAlreadyThere = $this->pokemonManager->getPokemonByName($pokemonName);
          if($pokemonAlreadyThere) {
            header("Location: /create-pokemon?error=pokemonAlreadyExists&name=". $pokemonName);
            exit();
          }
        } catch(Exception $e) {
            error_log($e->getMessage());
            throw new Exception($e->getMessage());
            exit();
        }

        try {
            $pokemonNewId = $this->createPokemonManager->insertNewPokemon($pokemonImage, $pokemonName, $pokemonType, 'png');
            header("Location: /create-pokemon?success=pokemonCreated&id=" . $pokemonNewId);
            exit();
        } catch (Exception $e) {
            error_log($e->getMessage());
            throw new Exception($e->getMessage());
            exit();
        }
    } 
}
