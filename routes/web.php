<?php

use App\Http\Controllers\guruController;
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


// Route::resource('guru','guruController');

Route::group(['prefix' => 'guru', 'as' => 'guru.'], function () {
    Route::get('/', [guruController::class, 'index']);
    Route::get('/get', [guruController::class, 'get'])->name('get');
    Route::post('/simpan', [guruController::class, 'simpan'])->name('simpan');
    Route::post('/hapus', [guruController::class, 'hapus'])->name('hapus');
});

// request()->in_array()
// Route::controller(GuruController::class)->prefix('guru')->as('guru.')->group(function() {
//     Route::get('/','index')->name('index');
//     Route::get('/get','get')->name('get');
//     Route::post('/simpan','simpan')->name('simpan');
// });
