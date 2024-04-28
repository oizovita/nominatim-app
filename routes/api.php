<?php


use App\Http\Controllers\DataController;
use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;

Route::put('data/refresh', [DataController::class, 'refresh']);
Route::get('data/search', [DataController::class, 'search']);
Route::get('jobs', [JobController::class, 'index']);
