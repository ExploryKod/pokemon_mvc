<?php 

namespace Pokemon\Entity;

class WeaponEffects extends BaseEntity
{
    private int | null $id = 0;
    private int | null $weaponId = 0;
    private int | null $pokemonId = 0;
    private int $defenseLoss = 0;

    /**
     * @return int|null
     */
    public function getId(): int | null
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return WeaponEffects
     */
    public function setId(int | null $id): WeaponEffects
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getWeaponId(): int | null
    {
        return $this->weaponId;
    }

    /**
     * @param int|null $weaponId
     * @return WeaponEffects
     */
    public function setWeaponId(int | null $weaponId): WeaponEffects
    {
        $this->weaponId = $weaponId;
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
     * @return WeaponEffects
     */
    public function setPokemonId(int | null $pokemonId): WeaponEffects
    {
        $this->pokemonId = $pokemonId;
        return $this;
    }

    /**
     * @return int
     */
    public function getDefenseLoss(): int
    {
        return $this->defenseLoss;
    }

    /**
     * @param int $defenseLoss
     * @return WeaponEffects
     */
    public function setDefenseLoss(int $defenseLoss): WeaponEffects
    {
        $this->defenseLoss = $defenseLoss;
        return $this;
    }
}