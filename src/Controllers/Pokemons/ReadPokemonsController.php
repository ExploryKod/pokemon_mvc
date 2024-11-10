<?php 
namespace Pokemon\Controllers\Pokemons;
use Pokemon\Factory\PDOFactory;
use Pokemon\Manager\Pokemons\PokemonManager;

class ReadPokemonsController {

    private PokemonManager $pokemonsManager;

    public function __construct(PDOFactory $conn) {
        $this->pokemonsManager = new PokemonManager($conn);
    }

    public function getPokemons() {
      $pokemons = $this->pokemonsManager->getPokemons();
      return $pokemons;
    }

    public function getPokemonById(int $id) {
      $pokemons = $this->pokemonsManager->getPokemonById($id);
      return $pokemons;
    }
}