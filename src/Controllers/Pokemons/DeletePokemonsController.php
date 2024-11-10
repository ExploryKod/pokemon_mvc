<?php
namespace Pokemon\Controllers\Pokemons;
use Pokemon\Factory\PDOFactory;
use Pokemon\Controllers\createPage;
use Pokemon\Manager\Pokemons\DeletePokemonManager;

class DeletePokemonsController extends createPage {

    private DeletePokemonManager $deletePokemonManager;

    public function __construct(PDOFactory $conn) {
        $this->deletePokemonManager = new DeletePokemonManager($conn);
    }

    public function deleteAllPokemons() {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /?error=method-not-allowed');
            exit();
        }

        if(!isset($_POST['csrf_token'])) {
            header('Location: /?error=missing&item=token');
            exit();
        }

        if(!$this->isValidCsrfToken($_POST['csrf_token'])) {
            header('Location: /?error=invalid-token');
            exit();
        }

        $this->deletePokemonManager->deleteAllPokemons();  
    }
   
    public function deletePokemonById(): void {
       
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /?error=method-not-allowed');
            exit();
        }

        if(!isset($_POST['csrf_token'])) {
            header('Location: /?error=missing&item=token');
            exit();
        }

        if(!$this->isValidCsrfToken($_POST['csrf_token'])) {
            header('Location: /?error=invalid-token');
            exit();
        }

        if(!isset($_POST['pokemon-name'])) {
            header('Location: /?error=missing&item=nom');
            exit();
        }

        $pokemonId = filter_var($_POST['id'], FILTER_VALIDATE_INT);
        $pokemonDeletedName = htmlspecialchars($_POST['pokemon-name'], ENT_QUOTES);

        if(!$pokemonId) {  
            header('Location: /?error=pokemon-id-invalid');
            exit();
        }

        if(!$pokemonDeletedName) {  
            header('Location: /?error=pokemon-deleted-name-invalid');
            exit();
        }

        $this->deletePokemonManager->deletePokemonById($pokemonId);  
        header('Location: /?success=pokemon-deleted&item' . $pokemonDeletedName);
        exit();
    }

    private function isValidCsrfToken(string $token): bool {
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }
}