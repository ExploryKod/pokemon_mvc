<?php 
namespace Pokemon\Controllers\Pokemons;
use Pokemon\Factory\PDOFactory;
use Pokemon\Manager\Pokemons\PokemonManager;
use Pokemon\Manager\Pokemons\UpdatePokemonsManager;

class UpdatePokemonsController {

    private PDOFactory $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function updatePokemon()
    {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (isset($_POST['update-pokemon'])) {

                $pokemonName =  filter_input(INPUT_POST, "pokemon-name");
                $pokemonFormId = intval(htmlspecialchars($_POST['pokemon-id']));
                $pokemonManager = new PokemonManager($this->conn);
                $updateManager = new UpdatePokemonsManager($this->conn);
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
                    
                    header("Location: \modify-pokemon?id=' . $pokemonFormId . '");
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

