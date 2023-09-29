<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminPlaceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('home.home');
// });

//Index
Route::get('/', [HomeController::class, 'index']);
Route::get('/list-place', [HomeController::class, 'index']);
Route::get('/detailplace/{id}', [HomeController::class, 'detail_place']);

Route::get('/map', function () {
    return view('home.map');
});

Route::get('/routing', function () {
    return view('home.routing');
});

Route::get('/introduction', function () {
    return view('home.introduction');
});

Route::get('/autosearch', function () {
    return view('home.autosearch');
});


Route::get('/place', [PlaceController::class, 'index']);
Route::get('/login', [LoginController::class, 'index']);
Route::get('/register', [LoginController::class, 'register_view']);
// Route::post('/login/auth', [LoginController::class, 'login']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [LoginController::class, 'register']);

Route::get('/image', function () {
    return view('home.image');
});
Route::post('/upload', [ImageController::class, 'upload']);

//For Admin Type
Route::get('/admin', [AdminController::class, 'index']);
Route::get('/admin/index', [AdminPlaceController::class, 'index']);
Route::post('/admin/place/add', [AdminPlaceController::class, 'store']);