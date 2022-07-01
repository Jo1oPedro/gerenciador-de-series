<?php

use App\Http\Controllers\SeasonsController;
use App\Http\Controllers\SeriesController;
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

/*Route::get('/', function () {
    return view('welcome');
});*/

/*Route::controller(SeriesController::class)->group(function() {
    Route::get('/', 'index');
    Route::get('/series', 'index')->name('series.create');
    Route::get('/series/create', 'create');
    Route::post('/series/store', 'store');
});*/

//Route::post('/series/destroy/{id}', [SeriesController::class, 'destroy'])->name('series.destroy');
Route::get('/', [SeriesController::class, 'index']);
Route::resource('/series', SeriesController::class);
Route::get('/series/{series}/seasons', [SeasonsController::class, 'index'])->name('seasons.index');
//->only(['index', 'create', 'store', 'delete']);
