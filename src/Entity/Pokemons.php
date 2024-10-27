<?php
namespace Els\Entity;

class Pokemons extends BaseEntity
{
    private int | null $id = 0;
    private string $image = "";
    private string $name = "";
    private string $type = "";

    /**
     * @return int|null
     */
    public function getId(): int | null
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return Pokemons
     */
    public function setId(int | null $id): Pokemons
    {
        $this->id = $id;
        return $this;
    }

       /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param string $name
     * @return Pokemons
     */
    public function setImage(string $image): Pokemons
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Pokemons
     */
    public function setName(string $name): Pokemons
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Pokemons
     */
    public function setType(string $type): Pokemons
    {
        $this->type = $type;
        return $this;
    }
}
?>
