<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchDataRequest;
use App\Http\Resources\SearchDataResource;
use App\Services\Oblast\SearchOblastService;

class DataController extends Controller
{
    private SearchOblastService $searchOblastService;

    public function __construct(SearchOblastService $searchOblastService)
    {
        $this->searchOblastService = $searchOblastService;
    }

    public function refresh()
    {

    }

    public function search(SearchDataRequest $request): SearchDataResource
    {
        $data = $request->validated();
        return new SearchDataResource($this->searchOblastService->run($data['lat'], $data['lon']));
    }
}
