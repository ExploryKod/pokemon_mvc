<?php 
namespace Pokemon\Controllers\Pokemons;
use Pokemon\Factory\PDOFactory;
use Pokemon\Manager\Pokemons\PokemonManager;

class ReadPokemons {

    public function getPokemons() {
        $conn = new PDOFactory(
            getenv('DB_HOST'),
            getenv('DB_PORT'),
            getenv('DB_NAME'),
            getenv('DB_USER'),
            getenv('DB_PASSWORD')
        );
    
      $pokemonsManager = new PokemonManager($conn);
      $pokemons = $pokemonsManager->getPokemons();
      return $pokemons;
    }
}