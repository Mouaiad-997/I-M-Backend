<?php

use App\Http\Controllers\newcontroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();});
// Route::get("data/",[newcontroller::class,'getData']);
// Route::get("data/{id}",[newcontroller::class,'getDataByID']);
// Route::post("data",[newcontroller::class,'storeWithApi']);
// Route::get("data/{id}",[newcontroller::class,'delete']);
// Route::get("search/{name}",[newcontroller::class,'search']);


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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post("addBooking", [CategoriesController::class, 'addBooking']);
    Route::post("addFavourite", [CategoriesController::class, 'addFavourite']);
    Route::get("showBookings/{barrier_id}", [CategoriesController::class, 'showBookings']);
    Route::get("showFavourites/{barrier_id}", [CategoriesController::class, 'showFavourites']);
});


Route::post("loginUser", [UserController::class, 'login']);
Route::post("singinUser", [UserController::class, 'singin']);
//mainpage
Route::get("boys/{categorie}", [CategoriesController::class, 'showBoys']);
Route::get("girls/{categorie}", [CategoriesController::class, 'showGirls']);
Route::get("men/{categorie}", [CategoriesController::class, 'showMen']);
Route::get("womens/{categorie}", [CategoriesController::class, 'showWomens']);





//Dashboard
Route::get("categories", [DashboardController::class, 'show']);
Route::post("storeCategories", [DashboardController::class, 'store']);
Route::delete("deleteCategories/{id}", [DashboardController::class, 'destroy']);
Route::get("search/{name}", [DashboardController::class, 'search']);
Route::get("numOfCategories", [DashboardController::class, 'numOfCategories']);
Route::put("updateCategorie/{id}", [DashboardController::class, 'update']);
//Dashboard admin
Route::post("singup", [AdminController::class, 'singup']);
Route::post("login", [AdminController::class, 'login']);
