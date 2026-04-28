<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\mata_kuliahController;
use App\Http\Controllers\jadwalController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/mata-kuliah', mata_kuliahController::class);
Route::apiResource('/jadwal', jadwalController::class);