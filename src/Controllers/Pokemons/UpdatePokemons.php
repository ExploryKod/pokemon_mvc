<?php 
namespace Pokemon\Controllers\Pokemons;
use Pokemon\Factory\PDOFactory;
use Pokemon\Manager\Pokemons\PokemonManager;
use Pokemon\Manager\Pokemons\UpdatePokemonsManager;

class UpdatePokemon {

    public function updatePokemon()
    {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (isset($_POST['update-pokemon'])) {

                $pokemonName =  filter_input(INPUT_POST, "pokemon-name");
                $pokemonFormId = intval(htmlspecialchars($_POST['pokemonId']));
                $pokemonManager = new PokemonManager(new PDOFactory());
                $updateManager = new UpdatePokemonsManager(new PDOFactory());
                $pokemon = $pokemonManager->getPokemonById($pokemonFormId);

                if($pokemon) {
                    $args = [];
                    $updateFeed = [
                        'pokemonName' => filter_input( INPUT_POST, "pokemon-name") ?? null,
                        'image' => filter_input( INPUT_POST, "image") ?? null,
                        'type' => filter_input( INPUT_POST, "type") ?? null
                    ];
                    foreach($updateFeed as $key => $value) {
                        if($value !== null) {
                            $args[$key] = $value;
                        }
                    }

                    $updateManager->updatePokemon($pokemonFormId, $pokemonName, $args);
                    
                    header('Location: \?success=updatepokemon');
                    exit();
                } else {
                    header('Location: \?error=nopokemontoupdate');
                    exit();
                }
                header('Location: \?error=submitnotworking');
                exit();

            }
            header('Location: \?error=nopostmethod');
            exit();
        }

    }
}

