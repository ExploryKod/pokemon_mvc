<?php
namespace Pokemon\Manager\Pokemons;
use Pokemon\Manager\BaseManager;

class CreatePokemonManager extends BaseManager {

    // /**
    //  * @param int|null $pokemonId
    //  * @param string|null $pokemonName
    //  * @param array $args
    //  * @return int The id of the new pokemon we just created
    //  */
    // public function insertNewPokemon(string $pokemonImage, string $pokemonName, string $pokemonType, string $extension): int
    // {
    //     $query = $this->pdo->prepare("INSERT INTO pokemons (image, name, type, extension) VALUES (:image, :name, :type, :extension)");
    //     $query->bindValue("image", $pokemonImage, \PDO::PARAM_STR);
    //     $query->bindValue("name", $pokemonName, \PDO::PARAM_STR);
    //     $query->bindValue("type", $pokemonType, \PDO::PARAM_STR);
    //     $query->bindValue("extension", $extension, \PDO::PARAM_STR);
    //     $query->execute();

    //     return (int) $this->pdo->lastInsertId();
    // }



/**
 * @param string $pokemonImage
 * @param string $pokemonName
 * @param string $pokemonType
 * @param string $extension
 * @return int The id of the new pokemon we just created
 */
public function insertNewPokemon(string $pokemonImage, string $pokemonName, string $pokemonType, string $description, string $extension): int
{
    try {
        
        $this->pdo->beginTransaction();

        $queryPokemon = $this->pdo->prepare("INSERT INTO pokemons (image, name, type, description, extension) VALUES (:image, :name, :type, :description, :extension)");
        $queryPokemon->bindValue("image", $pokemonImage, \PDO::PARAM_STR);
        $queryPokemon->bindValue("name", $pokemonName, \PDO::PARAM_STR);
        $queryPokemon->bindValue("type", $pokemonType, \PDO::PARAM_STR);
        $queryPokemon->bindValue("description", $description, \PDO::PARAM_STR);
        $queryPokemon->bindValue("extension", $extension, \PDO::PARAM_STR);
        $queryPokemon->execute();

        $pokemonId = (int) $this->pdo->lastInsertId();

        $defaultPowers = $this->getDefaultPowersByType($pokemonType);
        
        $queryPowers = $this->pdo->prepare("INSERT INTO powers (
                pokemon_id, 
                attack_name, 
                attack_points, 
                defense_points
            ) VALUES (
                :pokemon_id,
                :attack_name,
                :attack_points,
                :defense_points
            )
        ");

        $queryPowers->bindValue("pokemon_id", $pokemonId, \PDO::PARAM_INT);
        $queryPowers->bindValue("attack_name", $defaultPowers['attack_name'], \PDO::PARAM_STR);
        $queryPowers->bindValue("attack_points", $defaultPowers['attack_points'], \PDO::PARAM_INT);
        $queryPowers->bindValue("defense_points", $defaultPowers['defense_points'], \PDO::PARAM_INT);
        $queryPowers->execute();

        // Insert default weapon effects for common weapons
        $queryWeaponEffects = $this->pdo->prepare("
            INSERT INTO weapon_effects (
                weapon_id, 
                pokemon_id, 
                defense_loss
            ) 
            SELECT 
                w.id,
                :pokemon_id,
                CASE 
                    WHEN w.weakness_name = :pokemon_type THEN 40  -- Very effective
                    ELSE 25  -- Normal effectiveness
                END as defense_loss
            FROM weapons w
        ");
        
        $queryWeaponEffects->bindValue("pokemon_id", $pokemonId, \PDO::PARAM_INT);
        $queryWeaponEffects->bindValue("pokemon_type", $pokemonType, \PDO::PARAM_STR);
        $queryWeaponEffects->execute();

        // Commit the transaction
        $this->pdo->commit();
        
        return $pokemonId;

    } catch (\PDOException $e) {
        // Rollback the transaction if any query fails
        $this->pdo->rollBack();
        throw $e;
    }
}

/**
 * Helper method to determine default powers based on pokemon type
 * @param string $pokemonType
 * @return array
 */
private function getDefaultPowersByType(string $pokemonType): array
{
    // Default power values based on pokemon type
    $defaultPowers = [
        'Feu' => [
            'attack_name' => 'Flammèche',
            'attack_points' => 60,
            'defense_points' => 70
        ],
        'Eau' => [
            'attack_name' => 'Pistolet à O',
            'attack_points' => 55,
            'defense_points' => 65
        ],
        'Plante' => [
            'attack_name' => 'Fouet Lianes',
            'attack_points' => 50,
            'defense_points' => 75
        ],
        'Normal' => [
            'attack_name' => 'Charge',
            'attack_points' => 40,
            'defense_points' => 60
        ],
        'Insecte' => [
            'attack_name' => 'Piqûre',
            'attack_points' => 45,
            'defense_points' => 70
        ],
    ];

    // Extract the primary type if it's a dual-type pokemon (e.g., "Feu/Vol" -> "Feu")
    $primaryType = explode('/', $pokemonType)[0];

    // Return default powers for the type, or normal type powers if type not found
    return $defaultPowers[$primaryType] ?? $defaultPowers['Normal'];
}

}