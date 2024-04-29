<?php

namespace App\Services\Oblast;

use App\Models\Oblast;
use Illuminate\Support\Facades\Cache;

/**
 * Class DeleteOblastService
 * @package App\Services\Oblast
 */
class DeleteOblastService
{
    public function run()
    {
        Oblast::truncate();
        Cache::flush();
    }
}
