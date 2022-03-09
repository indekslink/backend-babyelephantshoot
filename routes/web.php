<?php

use App\Http\Controllers\{
    AuthController,
    HomeController,
    KTAController,
    UserController
};

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

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'postLogin'])->name('postLogin');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'postRegister'])->name('postRegister');
});


Route::get('/kta/scan/{username}', [KTAController::class, 'scan'])->name('scan_kta');

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::prefix('kta')->group(function () {
        Route::get('/', [KTAController::class, 'index']);
        Route::get('/stream/{type}', [KTAController::class, 'stream'])->name('stream.kta');
    });

    Route::resources([
        'users' => UserController::class,
    ]);

    Route::put('/update-autentikasi', [AuthController::class, 'update_autentikasi'])->name('update.autentikasi');



    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
