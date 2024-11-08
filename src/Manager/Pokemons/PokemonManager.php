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
    public function getPokemonById(int $id): ?Pokemons
    {
        $getPokemonReq = $this->pdo->prepare("SELECT id, image, name, type FROM pokemons WHERE id = :id");
        $getPokemonReq->execute(['id' => $id]);

        $data = $getPokemonReq->fetch(\PDO::FETCH_ASSOC);
        return $data ? new Pokemons($data) : null;
    }

     /**
     * @param int $id
     * @return void
     */
    public function deletePokemonById(int $pokemon_id){
        $dropPostReq = $this->pdo->prepare("DELETE FROM pokemons WHERE id = :pokemon_id");
        $dropPostReq->execute([
            'pokemon_id' => $pokemon_id
        ]);
    }
}
?>
