<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/test', function () {
//     return view('layouts/index');
// });

Route::get('/movies',[App\Http\Controllers\MoviesController::class,'index'] )->name('movies.index');
Route::get('/movies/{movie}',[App\Http\Controllers\MoviesController::class,'show'] )->name('movies.show');

Route::view('/', 'index');
Route::view('/movie', 'show');