<?php

namespace App\Http\Controllers;

use App\Http\Requests\RefreshDataRequest;
use App\Http\Requests\SearchDataRequest;
use App\Http\Resources\SearchDataResource;
use App\Jobs\ImportOblastPolygons;
use App\Services\Oblast\DeleteOblastService;
use App\Services\Oblast\SearchOblastService;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class DataController
 */
class DataController extends Controller
{
    private SearchOblastService $searchOblastService;
    private DeleteOblastService $deleteOblastService;

    public function __construct(
        SearchOblastService $searchOblastService,
        DeleteOblastService $deleteOblastService
    )
    {
        $this->searchOblastService = $searchOblastService;
        $this->deleteOblastService = $deleteOblastService;
    }

    /**
     * @param RefreshDataRequest $request
     * @return JsonResource
     */
    public function refresh(RefreshDataRequest $request): JsonResource
    {
        $data = $request->validated();
        ImportOblastPolygons::dispatch()->delay(now()->addSeconds((int)$data['delaySeconds']));
        return new JsonResource([
            'status' => 'success'
        ]);
    }

    /**
     * @param SearchDataRequest $request
     * @return SearchDataResource
     */
    public function search(SearchDataRequest $request): SearchDataResource
    {
        $data = $request->validated();
        return new SearchDataResource($this->searchOblastService->run($data['lat'], $data['lon']));
    }

    /**
     * @return JsonResource
     */
    public function delete(): JsonResource
    {
        $this->deleteOblastService->run();
        return new JsonResource([
            'status' => 'success'
        ]);
    }
}
