<?php

use App\Models\Dish;
use Illuminate\Support\Facades\Artisan;
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

Route::get('/', fn () => view('welcome'))->name('welcome');
Route::get('/clean', [ App\Http\Controllers\GameController::class, 'clean' ] )->name('clean');
Route::get('/play', [ App\Http\Controllers\GameController::class, 'play' ] )->name('play');
Route::get('/question', [ App\Http\Controllers\GameController::class, 'nextQuestion' ] )->name('question');
Route::post('/add-dish', [ App\Http\Controllers\GameController::class, 'addDish' ] )->name('add-dish');
Route::post('/compare', [ App\Http\Controllers\GameController::class, 'compare' ] )->name('compare');
Route::get('/finally', fn() => view('done') );
