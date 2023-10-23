<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminPlaceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\AdminNewsController;
use App\Http\Controllers\AdminUserController;
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
Route::get('/list-place', [HomeController::class, 'listPlace']);
Route::get('/detailplace/{id}', [HomeController::class, 'detail_place']);

Route::get('/map', function () {
    return view('home.map');
});

Route::get('/test', function () {
    return view('home.test');
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


Route::get('/place', [HomeController::class, 'getPlaceAPI']);
Route::get('/login', [LoginController::class, 'index']);
Route::get('/register', [LoginController::class, 'register_view']);
// Route::post('/login/auth', [LoginController::class, 'login']);
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/register', [LoginController::class, 'register']);

Route::get('/image', function () {
    return view('home.image');
});
Route::post('/upload', [ImageController::class, 'upload']);

Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/me', [LoginController::class, 'me']);

// //For Admin Type
// Route::get('/admin', [AdminController::class, 'index']);
// //Admin Place
// Route::get('/admin/place', [AdminPlaceController::class, 'index']);
// Route::post('/admin/place/add', [AdminPlaceController::class, 'store']);
// Route::put('/admin/place/edit/{id}', [AdminPlaceController::class, 'update']);
// Route::get('/admin/place/detail/{id}', [AdminPlaceController::class, 'getVLPlace']);
// Route::delete('/admin/place/delete/{id}', [AdminPlaceController::class, 'delete']);
// //Admin News
// Route::get('/admin/news', [AdminNewsController::class, 'index']);
// //Admin User
// Route::get('/admin/users', [AdminUserController::class, 'index']);

Route::middleware(['auth', 'role-check:admin'])->group(function () {
    //For Admin Type
    Route::get('/admin', [AdminController::class, 'index']);
    //Admin Place
    Route::get('/admin/place', [AdminPlaceController::class, 'index']);
    Route::post('/admin/place/add', [AdminPlaceController::class, 'store']);
    Route::put('/admin/place/edit/{id}', [AdminPlaceController::class, 'update']);
    Route::get('/admin/place/detail/{id}', [AdminPlaceController::class, 'getVLPlace']);
    Route::delete('/admin/place/delete/{id}', [AdminPlaceController::class, 'delete']);
    //Admin News
    Route::get('/admin/news', [AdminNewsController::class, 'index']);
    Route::post('/admin/news/add', [AdminNewsController::class, 'store']);
    Route::put('/admin/news/edit/{id}', [AdminNewsController::class, 'update']);
    Route::get('/admin/news/detail/{id}', [AdminNewsController::class, 'getVLNews']);
    Route::delete('/admin/news/delete/{id}', [AdminNewsController::class, 'delete']);
    //Admin User
    Route::get('/admin/users', [AdminUserController::class, 'index']);
});