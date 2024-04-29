<?php

namespace App\Repositories\Nominatim;

use App\Repositories\Nominatim\Dto\NominatimGeoJsonDto;
use App\Repositories\Nominatim\Exceptions\NominatimClientException;
use App\Repositories\Nominatim\Exceptions\NominatimServerException;
use App\Repositories\Nominatim\Exceptions\NominatimUnknownException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

/**
 * Class NominatimRepository
 */
class NominatimRepository
{

    /**
     * @param RequestException $exception
     * @return mixed
     */
    private function handleException(RequestException $exception)
    {
        if ($exception->getCode() >= 500) {
            throw new NominatimServerException($exception->getMessage(), $exception->getCode(), $exception->getPrevious());
        } elseif ($exception->getCode() >= 400 && $exception->getCode() < 500) {
            throw new NominatimClientException($exception->getMessage(), $exception->getCode(), $exception->getPrevious());
        } else {
            throw new NominatimUnknownException($exception->getMessage(), $exception->getCode(), $exception->getPrevious());
        }
    }

    /**
     * @param $country
     * @param $state
     * @return NominatimGeoJsonDto
     */
    public function getPolygon($country, $state): NominatimGeoJsonDto
    {
        try {
            $data = Http::get(config('services.nominatim.url') . '/search',
                [
                    'country' => $country,
                    'state' => $state,
                    'format' => config('services.nominatim.format'),
                    'polygon_geojson' => config('services.nominatim.format'),
                ])
                ->throw()
                ->json();

            return new NominatimGeoJsonDto($data[0]['geojson']);
        } catch (RequestException $requestException) {
            $this->handleException($requestException);
        }
    }
}
