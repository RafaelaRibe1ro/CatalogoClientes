<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\SubcategoriaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return auth()->check() ? redirect('/clientes') : redirect('/login');
});

// Rotas de login/logout
Auth::routes(['register' => false]);

// Rotas protegidas
Route::middleware('auth')->group(function () {
    Route::resource('clientes', ClienteController::class);
    Route::resource('categorias', CategoriaController::class)->except(['show']);
    Route::resource('subcategorias', SubcategoriaController::class)
      ->except(['show']);
});
