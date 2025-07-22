<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Subcategoria;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::get('/subcategorias/{categoria}', function ($categoria) {
    return Subcategoria::where('categoria_id', $categoria)
           ->orderBy('nome')->get(['id','nome']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
