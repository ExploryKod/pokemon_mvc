<?php

namespace Pokemon\Traits;

trait Hydrator
{
    /**
     * Converts a snake_case string to camelCase
     *
     * @param string $key
     * @return string
     */
    private function getCamelCase(string $key): string
    {
        $parts = explode('_', $key);
        $camelCase = $parts[0];
        for ($i = 1; $i < count($parts); $i++) {
            $camelCase .= ucfirst($parts[$i]);
        }
        return $camelCase;
    }

    /**
     * @param array $data
     * @return void
     */
    public function hydrate(array $data): void
    {
        foreach ($data as $key => $value) {

            $method = 'set' . ucfirst($this->getCamelCase($key));

            if (is_callable([$this, $method])) {
                $this->$method($value);
            }
        }
    }
}
