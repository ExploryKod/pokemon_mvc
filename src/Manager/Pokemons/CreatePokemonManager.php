<?php
namespace Pokemon\Manager\Pokemons;
use Pokemon\Manager\BaseManager;

class CreatePokemonManager extends BaseManager {

    /**
     * @param int|null $pokemonId
     * @param string|null $pokemonName
     * @param array $args
     * @return int The id of the new pokemon we just created
     */
    public function insertNewPokemon(string $pokemonImage, string $pokemonName, string $pokemonType, string $extension): int
    {
        $query = $this->pdo->prepare("INSERT INTO pokemons (image, name, type, extension) VALUES (:image, :name, :type, :extension)");
        $query->bindValue("image", $pokemonImage, \PDO::PARAM_STR);
        $query->bindValue("name", $pokemonName, \PDO::PARAM_STR);
        $query->bindValue("type", $pokemonType, \PDO::PARAM_STR);
        $query->bindValue("extension", $extension, \PDO::PARAM_STR);
        $query->execute();

        return (int) $this->pdo->lastInsertId();
    }

}