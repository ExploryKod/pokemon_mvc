<?php
namespace Pokemon\Manager\Pokemons;

use Pokemon\Entity\Pokemons;
use Pokemon\Manager\BaseManager;
use Pokemon\Traits\Hydrator;

class PokemonManager extends BaseManager
{
    use Hydrator;

    /**
     * @return Pokemons[]
     */
    public function getPokemons(): array
    {
        $query = $this->pdo->query("SELECT id, image, name, type, description, extension FROM pokemons");
        $pokemons = [];

        while ($data = $query->fetch(\PDO::FETCH_ASSOC)) {
            $pokemons[] = new Pokemons($data);
        }

        return $pokemons;
    }

    /**
     * @param int $id
     * @return Pokemons|null
     */
    public function getPokemonById(int $id): ?Pokemons
    {
        $getPokemonReq = $this->pdo->prepare("SELECT id, image, name, type, description, extension FROM pokemons WHERE id = :id");
        $getPokemonReq->execute(['id' => $id]);

        $data = $getPokemonReq->fetch(\PDO::FETCH_ASSOC);
        return $data ? new Pokemons($data) : null;
    }

    /**
     * @param string $pokemonName
     * @return Pokemons|null
     */
    public function getPokemonByName(string $pokemonName): ?Pokemons
    {
        $getPokemonReq = $this->pdo->prepare("SELECT id, image, name, type, description, extension FROM pokemons WHERE name = :pokemonName");
        $getPokemonReq->execute(['pokemonName' => $pokemonName]);

        $data = $getPokemonReq->fetch(\PDO::FETCH_ASSOC);
        return $data ? new Pokemons($data) : null;
    }
}
?>
