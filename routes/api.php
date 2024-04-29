<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\BenefitController;
use App\Http\Controllers\DocumentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/beneficios/{user_id}', [UserController::class, 'benefits']);
Route::get('/filtros', [BenefitController::class, 'index']);
Route::get('/fichas', [DocumentController::class, 'index']);
Route::get('/beneficios-validos', [BenefitController::class, 'validBenefits']);
