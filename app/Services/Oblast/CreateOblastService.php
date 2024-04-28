<?php

namespace App\Services\Oblast;

use App\Dto\Oblast\CreateOblastDto;
use App\Models\Oblast;
use Illuminate\Support\Facades\DB;

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
