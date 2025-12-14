<?php

use Illuminate\Support\Facades\Route;

// Rota principal - Página inicial do sistema
Route::get('/', function () {
    return view('home');
})->name('home');

// Rota para listar automóveis
Route::get('/automoveis', function () {
    return view('automoveis.index');
})->name('automoveis.index');

// Rota para cadastrar automóvel
Route::get('/automoveis/create', function () {
    return view('automoveis.create');
})->name('automoveis.create');

// Rota para ver detalhes do automóvel
Route::get('/automoveis/{id}', function ($id) {
    return view('automoveis.show', ['id' => $id]);
})->name('automoveis.show');

// Rota para documentação da API
Route::get('/api/documentacao', function () {
    return view('api.documentacao');
})->name('api.documentacao');

// Rota para sobre
Route::get('/sobre', function () {
    return view('sobre');
})->name('sobre');

// Rota de fallback (se a página não existir)
Route::fallback(function () {
    return view('errors.404');
});
