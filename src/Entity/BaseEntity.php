<?php
// Le traits hydrator permet de itérer directement sur tout les setter et getter qui seront dans le param de cette class

namespace Pokemon\Entity;

use Pokemon\Traits\Hydrator;

abstract class BaseEntity
{
    use Hydrator;

    public function __construct(array $data = [])
    {
        $this->hydrate($data);
    }
}
