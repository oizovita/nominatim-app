<?php


use App\Http\Controllers\DataController;
use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;

Route::delete('data', [DataController::class, 'delete']);
Route::put('data/refresh', [DataController::class, 'refresh'])->middleware('throttle:refresh');
Route::get('data/search', [DataController::class, 'search']);
Route::get('jobs', [JobController::class, 'index']);
