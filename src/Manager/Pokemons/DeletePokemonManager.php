<?php

namespace Pokemon\Manager\Pokemons;

use Pokemon\Manager\BaseManager;
use Pokemon\Traits\Hydrator;

class DeletePokemonManager extends BaseManager {

    use Hydrator;

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

    /**
     * @param int $id
     * @return void
     */
    public function deleteAllPokemons(){
        $dropPostReq = $this->pdo->prepare("DELETE FROM pokemons");
        $dropPostReq->execute();
    }

}