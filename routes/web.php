<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruController;
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


// Route::get('/auth', function () {
//     return view('auth.index');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard.index');
// });

Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
    // Route::get('/', function(){
    //     return route('auth.index');
    //     // return route('auth');
    // });
    Route::get('/', [AuthController::class, 'index'])->name('/');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});


// Route::resource('guru','guruController');
// Route::group(['middleware' => ['auth']], function () {

Route::group([
    'middleware'=>['auth'],
    'prefix' => 'dashboard',
    'as' => 'dashboard.'
    ], function () {
    // Route::get('/', function() {
    //     return view('dashboard.index');
    // });
    Route::get('/', [DashboardController::class, 'ndashmu'])->name('zed');
    // Route::get('/ndashmu', [DashboardController::class, 'ndashmu'])->name('zed');

// Route::get('/get', [guruController::class, 'get'])->name('get');
// Route::post('/simpan', [guruController::class, 'simpan'])->name('simpan');
// Route::post('/hapus', [guruController::class, 'hapus'])->name('hapus');
});

Route::group([
        'middleware'=>['auth'],
        'prefix' => 'guru',
        'as' => 'guru.'
    ], function () {
    Route::get('/', [GuruController::class, 'index']);
    Route::get('/get', [GuruController::class, 'get'])->name('get');
    Route::post('/simpan', [GuruController::class, 'simpan'])->name('simpan');
    Route::post('/hapus', [GuruController::class, 'hapus'])->name('hapus');
});


// request()->in_array()
// Route::controller(GuruController::class)->prefix('guru')->as('guru.')->group(function() {
//     Route::get('/','index')->name('index');
//     Route::get('/get','get')->name('get');
//     Route::post('/simpan','simpan')->name('simpan');
// });
