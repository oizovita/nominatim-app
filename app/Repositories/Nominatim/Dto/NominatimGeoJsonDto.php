<?php

namespace App\Repositories\Nominatim\Dto;

/**
 * Class NominatimGeoJsonDto
 */
class NominatimGeoJsonDto
{
    private string $type;
    private array $coordinates;

    /**
     * NominatimGeoJsonDto constructor.
     * @param array $data
     */
    public function __construct($data)
    {
        $this->type = $data['type'];
        $this->coordinates = $data['coordinates'];
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return array
     */
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
