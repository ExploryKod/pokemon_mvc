<?php
namespace Pokemon\Manager;

use Pokemon\Entity\Pokemons;
use Pokemon\Manager\PdoBaseManager;
use Pokemon\Traits\Hydrator;

class PokemonPdoManager extends pdoBaseManager
{
    use Hydrator;

    /**
     * @return Pokemons[]
     */
    public function getPokemons(): array
    {
        $query = $this->pdo->query("SELECT id, image, name, type FROM pokemons");
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
    public function getPokemon(int $id): ?Pokemons
    {
        $getPokemonReq = $this->pdo->prepare("SELECT id, name, type FROM pokemons WHERE id = :id");
        $getPokemonReq->execute(['id' => $id]);

        $data = $getPokemonReq->fetch(\PDO::FETCH_ASSOC);
        return $data ? new Pokemons($data) : null;
    }
}
?>
