<?php

use App\Http\Controllers\CuacaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/datacuaca', [CuacaController::class, 'get_data_cuaca']);
