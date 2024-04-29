<?php

namespace App\Services\Oblast;

use App\Models\Oblast;
use Illuminate\Support\Facades\Cache;

/**
 * Class SearchOblastService
 * @package App\Services\Oblast
 */
class SearchOblastService
{
    private const MAX_CACHE_SIZE = 100;
    private const CACHE_KEYS = 'oblast:cache_keys';

    /**
     * @param float $latitude
     * @param float $longitude
     * @return array
     */
    public function run(float $latitude, float $longitude): array
    {
        $cacheKey = "oblast:{$latitude},{$longitude}";
        $cacheTTL = 60;

        // Get the current cache keys
        $cacheKeys = Cache::get(self::CACHE_KEYS, []);

        // If the cache is full, remove the oldest key
        if (count($cacheKeys) >= self::MAX_CACHE_SIZE) {
            $oldestKey = array_shift($cacheKeys);
            Cache::forget($oldestKey);
        }

        // Add the new key to the array and update the cache
        $cacheKeys[] = $cacheKey;
        Cache::put(self::CACHE_KEYS, $cacheKeys, $cacheTTL);

        $fromCache = Cache::has($cacheKey);

        $oblast = Cache::remember($cacheKey, $cacheTTL, function () use ($latitude, $longitude) {
            return Oblast::whereRaw("ST_Contains(area, ST_GeomFromText('POINT($latitude $longitude)', 4326))")->first();
        });

        return ['oblast' => $oblast, 'cache' => $fromCache];
    }
}
