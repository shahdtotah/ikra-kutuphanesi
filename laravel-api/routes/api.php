<?php

use App\Models\Favorites;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\BooksController;
use App\Http\Controllers\Api\V1\WritersController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\FavoritesController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('createFavorite',[FavoritesController::class,'createFavorite']);
Route::post('removeFavorite',[FavoritesController::class,'removeFavorite']);
Route::middleware('auth:api')->get('/user', [AuthController::class, 'user']);
Route::post('/login/google', [AuthController::class, 'loginWithGoogle']);

Route::group(['prefix'=>'v1','namespace'=>'App\Http\Controllers\Api\V1'],function(){
    Route::apiResource('writers',WritersController::class);
    Route::apiResource('books',BooksController::class);
    Route::apiResource('users',UserController::class);
    Route::apiResource('favorites',FavoritesController::class);
    

});