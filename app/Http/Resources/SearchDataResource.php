<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class SearchDataResource
 */
class SearchDataResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'geo' => [
                'oblast' => $this->resource['oblast']->name,
                'cache' => $this->resource['cache']
            ]
        ];
    }
}
