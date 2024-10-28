<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestAuthController;


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
Route::get('/', [GuestAuthController::class, 'showLoginForm'])->name('guest.login');
Route::post('/guest-login', [GuestAuthController::class, 'login'])->name('guest.login.post');
Route::get('/dashboard/{token?}', [GuestAuthController::class, 'gameBet']);
Route::post('/lucky7/play', [GuestAuthController::class, 'playGame'])->name('lucky7');
