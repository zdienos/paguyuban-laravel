<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect('/dashboard');
});

Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
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
    Route::get('/', [DashboardController::class, 'ndashmu'])->name('zed');
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


Route::group([
    'middleware'=>['auth','roles'],
    'prefix' => 'user',
    'as' => 'user.'
], function () {
    Route::group(['roles'=>'superadmin'],function() {
        Route::get('/', [UserController::class, 'index']);
        Route::get('/get', [UserController::class, 'get'])->name('get');
        Route::post('/simpan', [UserController::class, 'simpan'])->name('simpan');
        Route::post('/hapus', [UserController::class, 'hapus'])->name('hapus');
    });
});


// request()->in_array()
// Route::controller(GuruController::class)->prefix('guru')->as('guru.')->group(function() {
//     Route::get('/','index')->name('index');
//     Route::get('/get','get')->name('get');
//     Route::post('/simpan','simpan')->name('simpan');
// });
