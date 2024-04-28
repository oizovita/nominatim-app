<?php

namespace App\Http\Controllers;

use App\Jobs\ImportOblastPolygons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Redis;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        ImportOblastPolygons::dispatch()->delay(now()->addSeconds(60));

        $j = Redis::command('zrange', ['queues:default:delayed', 0, 5]);

        $e = Redis::get('job:' . json_decode($j[0], true)['id'] . ':created_at');
        dd($e);
        dd(json_decode($j[0]));
        $r = json_decode($jobs[0], true)['data']['command'];

        foreach ($jobs as $job) {
            $payload = json_decode($job, true);
            dd($payload);
        }
//        dd(Redis::hget('queues:default:reserved', 1));
    }
}
