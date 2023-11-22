<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminPlaceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocaleController;
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
//Change Locale
Route::post('/updatelocale', [LocaleController::class, 'updateLocale'])->name('updateLocale');

//Information User
Route::get("/accountprofile", [HomeController::class, "accountProfile"]);
Route::post('/change-password', [LoginController::class, 'changePassword']);
Route::get('/forgot-passwd', [LoginController::class, 'forgotPassword']);
Route::post('/forgot-pass', [LoginController::class, 'forgotPass']);
Route::post('/change-info', [LoginController::class, 'changeInfo']);
Route::get('/login-check', [LoginController::class, 'loginCheck']);
//Index
Route::get('/', [HomeController::class, 'index']);

//Place
Route::get('/list-place', [HomeController::class, 'listPlace']);
Route::get('/detailplace/{id}', [HomeController::class, 'detailPlace']);
//Rating
Route::post('/rating-place', [HomeController::class, 'ratingPlace']);

//Recommend Place
Route::get('/recommend-place', [HomeController::class, 'recommendPlace']);
Route::post('/recommend-content', [HomeController::class, 'recommendContent']);

//News
Route::get('/news', [HomeController::class, 'fullListNews']);
Route::get('/list-news', [HomeController::class, 'listNews']);
Route::get('/list-event', [HomeController::class, 'listEvent']);
Route::get('/detailnews/{id}', [HomeController::class, 'detailNews']);


Route::get('/introduction', function () {
    return view('home.introduction');
});


//Auth Project
// Route::get('/place', [HomeController::class, 'getPlaceAPI']);
Route::get('/login', [LoginController::class, 'index']);
Route::get('/register', [LoginController::class, 'registerView']);
// Route::post('/login/auth', [LoginController::class, 'login']);
//Login for Modal
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/register', [LoginController::class, 'register']);

Route::get('/logout', [LoginController::class, 'logout']);


//Admin check
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
    Route::get('/admin/users/detail/{id}', [AdminUserController::class, 'getVLUser']);
    Route::put('/admin/users/edit/{id}', [AdminUserController::class, 'update']);
    Route::delete('/admin/users/delete/{id}', [AdminUserController::class, 'delete']);
});
