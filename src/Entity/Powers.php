<?php

namespace Pokemon\Entity;

class Powers extends BaseEntity
{
    private int | null $id = 0;
    private int | null $pokemonId = 0;
    private string $attackName = "";
    private int $attackPoints = 0;
    private int $defensePoints = 0;

    /**
     * @return int|null
     */
    public function getId(): int | null
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return Powers
     */
    public function setId(int | null $id): Powers
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getPokemonId(): int | null
    {
        return $this->pokemonId;
    }

    /**
     * @param int|null $pokemonId
     * @return Powers
     */
    public function setPokemonId(int | null $pokemonId): Powers
    {
        $this->pokemonId = $pokemonId;
        return $this;
    }

    /**
     * @return string
     */
    public function getAttackName(): string
    {
        return $this->attackName;
    }

    /**
     * @param string $nomAttaque
     * @return Powers
     */
    public function setAttackName(string $attackName): Powers
    {
        $this->attackName = $attackName;
        return $this;
    }

    /**
     * @return int
     */
    public function getAttackPoints(): int
    {
        return $this->attackPoints;
    }

    /**
     * @param int $pointsAttaque
     * @return Powers
     */
    public function setAttackPoints(int $attackPoints): Powers
    {
        $this->attackPoints = $attackPoints;
        return $this;
    }

    /**
     * @return int
     */
    public function getDefensePoints(): int
    {
        return $this->defensePoints;
    }

    /**
     * @param int $pointsDefense
     * @return Powers
     */
    public function setDefensePoints(int $defensePoints): Powers
    {
        $this->defensePoints = $defensePoints;
        return $this;
    }
}
