<?php
namespace Pokemon\Manager\Pokemons;
use Pokemon\Entity\Pokemons;
use Pokemon\Manager\BaseManager;

class UpdatePokemonsManager extends BaseManager {

    /**
     * @param int|null $pokemonId
     * @param string|null $pokemonName
     * @param array $args
     * @return void
     */
    public function updatePokemon(int | null $pokemonId, string | null $pokemonName, array $args = []): void
    {
        if(!empty($args)) {
            foreach($args as $key => $value) {
                if(!empty($key)){
                    switch ($key) {
                        case 'pokemonName':
                            $pokemonName = $args['pokemonName'];
                            $query = $this->pdo->prepare("UPDATE pokemons SET name = :pokemonName WHERE id=:pokemonId ");
                            $query->bindValue("pokemonName", $pokemonName, \PDO::PARAM_STR);
                            $query->bindValue("pokemonId", $pokemonId, \PDO::PARAM_STR);
                            $query->execute();
                            break;
                        case 'type':
                            $type = $args['type'];
                            $query = $this->pdo->prepare("UPDATE pokemons SET type = :type WHERE id=:pokemonId ");
                            $query->bindValue("type", $type, \PDO::PARAM_STR);
                            $query->bindValue("pokemonId", $pokemonId, \PDO::PARAM_STR);
                            $query->execute();
                            break;
                        case 'image':
                            $image = $args['image'];
                            $query = $this->pdo->prepare("UPDATE pokemons SET image = :image WHERE id=:pokemonId ");
                            $query->bindValue("image", $image, \PDO::PARAM_STR);
                            $query->bindValue("userId", $pokemonId, \PDO::PARAM_STR);
                            $query->execute();
                            break;
                    }
                }
            }
        }
    }

}