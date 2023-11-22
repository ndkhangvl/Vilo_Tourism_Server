<?php

use App\Http\Controllers\APIController;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/login', [APIController::class, 'login']);
//Get Place API
Route::get('/place', [APIController::class, 'getPlaceAPI']);
//Get News API 
Route::get('news', [APIController::class, 'getNewsAPI']);
Route::get('/recommend-place', [APIController::class, 'getRecommendPlace']);
Route::get('/recommend-rating', [APIController::class, 'getRecommendRating']);
Route::get('/recommend-user', [APIController::class, 'getRecommendUser']);

//Recommend Place
Route::get('/recommend-lplace', [APIController::class, 'recommendPlace']);