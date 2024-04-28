<?php

namespace App\Services\Oblast;

use App\Models\Oblast;

class SearchOblastService
{
    public function run(float $latitude, float $longitude): ?Oblast
    {
        return Oblast::whereRaw("ST_Contains(area, ST_GeomFromText('POINT($latitude $longitude)', 4326))")->first();
    }
}
