<?php

use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\SousCategorieController;
use App\Http\Controllers\ProduitController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', [UserController::class, 'profile']);
    Route::get('/logout', [UserController::class, 'logout']);
});

Route::post('login/users', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);

Route::resource('categorie', CategorieController::class);
Route::resource('sousCategorie', SousCategorieController::class);
Route::get('getIndex', [CategorieController::class,'getIndex']);
Route::get('catProduits/{id}', [SousCategorieController::class,'catProduits']);
Route::put('/categorie/{id}',[CategorieController::class,'update']);
Route::put('/sousCategorie/{id}',[SousCategorieController::class,'update']);

Route::apiResource('produits', ProduitController::class);
Route::post('modifierProduit/{id}', [ProduitController::class, 'modifierProduit']);