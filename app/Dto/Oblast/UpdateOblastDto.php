<?php

namespace App\Dto\Oblast;

/**
 * Class CreateOblastDto
 * @package App\Dto\Oblast
 */
class UpdateOblastDto
{
    private string $name;
    private string $area;

    public function __construct(string $name, string $area)
    {
        $this->name = $name;
        $this->area = $area;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getArea(): string
    {
        return $this->area;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'area' => $this->area,
        ];
    }
}
