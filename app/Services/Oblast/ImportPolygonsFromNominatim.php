<?php

namespace App\Services\Oblast;

use App\Dto\Oblast\CreateOblastDto;
use App\Dto\Oblast\UpdateOblastDto;
use App\Models\Oblast;
use App\Repositories\Nominatim\Dto\NominatimGeoJsonDto;
use App\Repositories\Nominatim\NominatimRepository;

/**
 * Class ImportPolygonsFromNominatim
 * @package App\Services\Oblast
 */
class ImportPolygonsFromNominatim
{
    public const STATES = [
        'Vinnytsia Oblast',
        'Volyn Oblast',
        'Dnipropetrovsk Oblast',
        'Donetsk Oblast',
        'Zhytomyr Oblast',
        'Zakarpattia Oblast',
        'Zaporizhia Oblast',
        'Ivano-Frankivsk Oblast',
        'Kyiv Oblast',
        'Kyiv',
        'Sumy Oblast',
        'Khmelnytskyi Oblast',
        'Kirovohrad Oblast',
        'Luhansk Oblast',
        'Lviv Oblast',
        'Mykolaiv Oblast',
        'Odessa Oblast',
        'Poltava Oblast',
        'Rivne Oblast',
        'Ternopil Oblast',
        'Kharkiv Oblast',
        'Kherson Oblast',
        'Cherkasy Oblast',
        'Chernivtsi Oblast',
        'Chernihiv Oblast',
        'Republic of Crimea'
    ];
    private NominatimRepository $repository;
    private CreateOblastService $createOblastService;
    private UpdateOblastService $updateOblastService;


    public function __construct(
        CreateOblastService $createOblastService,
        UpdateOblastService $updateOblastService,
        NominatimRepository $repository,
    )
    {
        $this->repository = $repository;
        $this->createOblastService = $createOblastService;
        $this->updateOblastService = $updateOblastService;
    }

    public function polygonToMultiPolygon(NominatimGeoJsonDto $geoJson): false|string
    {
        if ($geoJson->getType() === 'MultiPolygon') {
            return json_encode($geoJson->toArray());
        } else {
            return json_encode(['type' => 'MultiPolygon', 'coordinates' => [$geoJson->getCoordinates()]]);
        }
    }

    public function run()
    {
        $oblasts = Oblast::all()->keyBy('name');

        foreach (self::STATES as $state) {
            $geoJson = $this->repository->getPolygon('Ukraine', $state);
            $polygon = $this->polygonToMultiPolygon($geoJson);

            if ($oblast = $oblasts->get($state)) {
                $this->updateOblastService->run(
                    $oblast,
                    new UpdateOblastDto(
                        name: $state, area: "ST_GeomFromGeoJSON('$polygon')"
                    ));
            } else {
                $this->createOblastService->run(new CreateOblastDto(
                    name: $state, area: "ST_GeomFromGeoJSON('$polygon')"
                ));
            }
        }
    }


}
