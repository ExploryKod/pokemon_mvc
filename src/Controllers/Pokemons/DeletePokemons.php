<?php
namespace Pokemon\Controllers\Pokemons;
use Pokemon\Factory\PDOFactory;
use Pokemon\Controllers\AbstractController;
use Pokemon\Entity\Pokemons;
use Pokemon\Manager\Pokemons\PokemonManager;

class DeletePokemons extends AbstractController {

    private PDOFactory $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function deleteByName(Pokemons $pokemon): void {
        
    }
    
    public function deleteAll(Pokemons $pokemon): void {
        
    }

    // public function deleteById(): void {

    //     if($_GET['id']) {
    //         $pokemonId = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    //         $safePokemonId = htmlspecialchars($pokemonId , ENT_QUOTES, 'UTF-8');
    //         $pokemonManager = new PokemonManager($this->conn);
    //         $pokemonManager->deletePokemonById($safePokemonId);
    //         header('Location: /?success=pokemon-deleted');
    //         exit();
    //     } else {
    //         header('Location: /?error="pokemon-delete-error');
    //         exit();
    //     }

    
    // }

    public function deleteById(): void {
        // Only allow deletion on POST request to ensure safety
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Check if ID and CSRF token are set
            if (isset($_POST['id'], $_POST['csrf_token'])) {
                // Validate CSRF token
                if ($this->isValidCsrfToken($_POST['csrf_token'])) {

                    $pokemonId = filter_var($_POST['id'], FILTER_VALIDATE_INT);
    
                    if ($pokemonId !== false) {
                        $pokemonManager = new PokemonManager($this->conn);
                        $pokemonManager->deletePokemonById($pokemonId); 
                        header('Location: /?success=pokemon-deleted');
                        exit();
                    } else {
                        header('Location: /?error=pokemon-id-invalid');
                        exit();
                    }
                } else {
                    header('Location: /?error=csrf-token-invalid');
                    exit();
                }
            } else {
                header('Location: /?error=missing-data');
                exit();
            }
        } else {
            header('Location: /?error=invalid-request-method');
            exit();
        }
    }
    

    public function deleteByType(Pokemons $pokemon): void {
        
    }

    private function isValidCsrfToken(string $token): bool {
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }
}