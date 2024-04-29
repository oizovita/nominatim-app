<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Oblast
 * @package App\Models
 * @property string $name
 * @property float $area
 */
class Oblast extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'area',
        'created_at',
        'updated_at',
    ];
}
