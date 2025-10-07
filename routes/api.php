<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutomoveisController;

Route::get('/', function () {
    return response()->json(['sucesso' => true]);
});

Route::get('/automoveis', [AutomoveisController::class, 'index']);
Route::get('/automoveis/{id}', [AutomoveisController::class, 'show']);
Route::post('/automoveis', [AutomoveisController::class, 'store']);
Route::put('/automoveis/{id}', [AutomoveisController::class, 'update']);
Route::delete('/automoveis/{id}', [AutomoveisController::class, 'destroy']);
