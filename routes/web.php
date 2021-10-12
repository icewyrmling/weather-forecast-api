<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post("/testInsert", [App\Http\Controllers\WeatherController::class, 'store']);
Route::get("/testGet", [App\Http\Controllers\WeatherController::class, 'index']);
Route::post("/testDelete", [App\Http\Controllers\WeatherController::class, 'delete']);


Route::get("/getCities", [App\Http\Controllers\CityController::class, 'index']);
Route::post("/setTime", [App\Http\Controllers\WeatherController::class, 'setTime']);
