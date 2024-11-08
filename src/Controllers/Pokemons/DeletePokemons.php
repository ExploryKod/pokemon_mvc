<?php

namespace Pokemon\Controllers\Pokemons;
use Pokemon\Factory\PDOFactory;
use Pokemon\Controllers\AbstractController;
use Pokemon\Entity\Pokemons;
use Pokemon\Manager\Pokemons\PokemonManager;

class DeletePokemons extends AbstractController {

    public function deleteByName(Pokemons $pokemon): void {
        
    }
    
    public function deleteAll(Pokemons $pokemon): void {
        
    }

    public function deleteById(int $id): void {
        $conn = new PDOFactory(
            getenv('DB_HOST'),
            getenv('DB_PORT'),
            getenv('DB_NAME'),
            getenv('DB_USER'),
            getenv('DB_PASSWORD')
        );
        $pokemonManager = new PokemonManager($conn);
        $pokemonManager->deletePokemonById($id);
    }

    public function deleteByType(Pokemons $pokemon): void {
        
    }
}