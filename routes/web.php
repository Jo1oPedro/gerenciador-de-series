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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::get('/email', function () {
    return new App\Mail\SeriesCreated('Série de teste', 1, 5, 10);
});
require __DIR__.'/auth.php';