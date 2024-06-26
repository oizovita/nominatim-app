<?php

namespace App\Services\Oblast;

use App\Dto\Oblast\CreateOblastDto;
use App\Models\Oblast;
use Illuminate\Support\Facades\DB;

/**
 * Class CreateOblastService
 * @package App\Services\Oblast
 */
class CreateOblastService
{
    public function run(CreateOblastDto $dto): Oblast
    {
        return Oblast::create([
            'name' => $dto->getName(),
            'area' => DB::raw($dto->getArea()),
        ]);
    }
}
