<?php 
namespace Pokemon\Controllers\Pokemons;
use Pokemon\Factory\PDOFactory;
use Pokemon\Manager\Pokemons\PokemonManager;

class ReadPokemons {

    private PDOFactory $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getPokemons() {
      $pokemonsManager = new PokemonManager($this->conn);
      $pokemons = $pokemonsManager->getPokemons();
      return $pokemons;
    }

    public function getPokemonById(int $id) {
    
      $pokemonsManager = new PokemonManager($this->conn);
      $pokemons = $pokemonsManager->getPokemonById($id);
      return $pokemons;
    }
}