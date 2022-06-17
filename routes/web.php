<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\DB;

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

// route dashboard
Route::get('/get-movie-dashboard', function () {
    $data = DB::table('genres')->get();
  
    return view('dashboard.welcome', compact('data'));
});

Route::get('/', [HomeController::class, 'home']);

// get method Movie Controller
Route::get('/get-genre', [MovieController::class, 'getGenre'])->name('genre.get');
Route::get('get-movie/{id}', [MovieController::class, 'getMovieById'])->name('movie.get');
Route::get('/update', [MovieController::class, 'updateIsMovie']);

// get method Home Controller
Route::get('/get-slider', [HomeController::class, 'slider'])->name('slider.get');

// post method
Route::post('/insert-genre/{id}/{name}', [MovieController::class, 'insertGenre'])->name('genre.insert');
Route::post('/insert-movie', [MovieController::class, 'insertMovie'])->name('movie.insert');