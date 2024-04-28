<?php

namespace App\Services\Oblast;

use App\Dto\Oblast\UpdateOblastDto;
use App\Models\Oblast;
use Illuminate\Support\Facades\DB;

class UpdateOblastService
{
    public function run(Oblast $oblast, UpdateOblastDto $dto): Oblast
    {
        $oblast->update([
            'name' => $dto->getName(),
            'area' => DB::raw($dto->getArea()),
        ]);
        return $oblast;
    }
}
