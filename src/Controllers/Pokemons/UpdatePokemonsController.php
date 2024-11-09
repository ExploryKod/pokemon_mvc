<?php 
namespace Pokemon\Controllers\Pokemons;

use Pokemon\Controllers\createPage;
use Pokemon\Factory\PDOFactory;
use Pokemon\Manager\Pokemons\PokemonManager;
use Pokemon\Manager\Pokemons\UpdatePokemonsManager;

class UpdatePokemonsController extends createPage {

    private PDOFactory $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function updatePokemon()
    {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (isset($_POST['update-pokemon'])) {
                var_dump('enter update');
                $pokemonName =  filter_input(INPUT_POST, "pokemon-name");
                $pokemonFormImage =  filter_input(INPUT_POST, "image");
                $pokemonFormId =  filter_input(INPUT_POST, "pokemon-id");
                $pokemonManager = new PokemonManager($this->conn);
                $updateManager = new UpdatePokemonsManager($this->conn);
                $pokemon = $pokemonManager->getPokemonById(intval($pokemonFormId));

                if($pokemon) {
                    $args = [];
                    $updateFeed = [
                        'pokemonName' => filter_input( INPUT_POST, "pokemon-name") ?? null,
                        'image' => filter_input( INPUT_POST, "image") ?? null,
                        'type' => filter_input( INPUT_POST, "type") ?? null,
                        'extension' => 'png'
                    ];
                    foreach($updateFeed as $key => $value) {
                        if($value !== null) {
                            $args[$key] = $value;
                        }
                    }
                    
                    try {
                        $updateManager->updatePokemon($pokemonFormId, $pokemonName, $args);
                    } catch (\Exception $e) {
                        $pageData = [
                            "bodyId" => 'route-error',
                            "page_css_id" => 'page-error',
                            "meta" => [
                                "page_title" => "Erreur - Pokemon MVC",
                                "page_description" => 'Pokemon MVC - erreur 404',
                            ],
                            "view" => 'views/error.view.php',
                            "template" => "views/templates/template.php",
                            "data" => [
                                "css-footer" => "els-footer--fixed",
                                "message" => $e->getMessage(),
                                 "type" => "500"
                            ]
                        ];
                        $this->pageError($pageData);
                        exit();
                    }
                  
                    header("Location: /modify-pokemon?id=" . $pokemonFormId);
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

