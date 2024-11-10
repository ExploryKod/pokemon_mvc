<?php

namespace Pokemon\Entity;

class Weapons extends BaseEntity
{
    private int | null $id = 0;
    private string $weaponName = "";
    private string $weaknessName = "";
    private int $weaknessCasualties = 0;
    private string $strengthName = "";
    private int $strengthLevel = 0;
    private int $cost = 0;

    /**
     * @return int|null
     */
    public function getId(): int | null
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return Weapons
     */
    public function setId(int | null $id): Weapons
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getWeaponName(): string
    {
        return $this->weaponName;
    }

    /**
     * @param string $weaponName
     * @return Weapons
     */
    public function setWeaponName(string $weaponName): Weapons
    {
        $this->weaponName = $weaponName;
        return $this;
    }

    /**
     * @return string
     */
    public function getWeaknessName(): string
    {
        return $this->weaknessName;
    }

    /**
     * @param string $weaknessName
     * @return Weapons
     */
    public function setWeaknessName(string $weaknessName): Weapons
    {
        $this->weaknessName = $weaknessName;
        return $this;
    }

    /**
     * @return int
     */
    public function getWeaknessCasualties(): int
    {
        return $this->weaknessCasualties;
    }

    /**
     * @param int $weaknessCasualties
     * @return Weapons
     */
    public function setWeaknessCasualties(int $weaknessCasualties): Weapons
    {
        $this->weaknessCasualties = $weaknessCasualties;
        return $this;
    }

    /**
     * @return string
     */
    public function getStrengthName(): string
    {
        return $this->strengthName;
    }

    /**
     * @param string $strengthName
     * @return Weapons
     */
    public function setStrengthName(string $strengthName): Weapons
    {
        $this->strengthName = $strengthName;
        return $this;
    }

    /**
     * @return int
     */
    public function getStrengthLevel(): int
    {
        return $this->strengthLevel;
    }

    /**
     * @param int $strengthLevel
     * @return Weapons
     */
    public function setStrengthLevel(int $strengthLevel): Weapons
    {
        $this->strengthLevel = $strengthLevel;
        return $this;
    }

    /**
     * @return int
     */
    public function getCost(): int
    {
        return $this->cost;
    }

    /**
     * @param int $cost
     * @return Weapons
     */
    public function setCost(int $cost): Weapons
    {
        $this->cost = $cost;
        return $this;
    }
}

