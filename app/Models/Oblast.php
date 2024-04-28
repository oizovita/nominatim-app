<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
