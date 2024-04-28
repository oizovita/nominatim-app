<?php

namespace App\Repositories\Nominatim\Dto;

class NominatimGeoJsonDto
{
    private string $type;
    private array $coordinates;

    public function __construct($data)
    {
        $this->type = $data['type'];
        $this->coordinates = $data['coordinates'];
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getCoordinates(): array
    {
        return $this->coordinates;
    }

    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'coordinates' => $this->coordinates,
        ];
    }
}
