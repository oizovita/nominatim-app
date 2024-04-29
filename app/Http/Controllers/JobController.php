<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use Illuminate\Support\Facades\Redis;

/**
 * Class JobController
 */
class JobController extends Controller
{

    public function index(JobRequest $request)
    {
        $data = $request->validated();
        Redis::command('zrange', ['queues:default:delayed', 0, (int)$data['limit']]);

        return response()->json(status: 204);
    }
}
