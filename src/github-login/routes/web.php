<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorizationController;

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

Route::get('auth/github', [AuthorizationController::class, 'githubRedirect']);
Route::get('auth/github/callback', [AuthorizationController::class, 'githubCallback']);

Route::get('/dashboard', [AuthorizationController::class, 'dashboard'])->middleware('auth');
Route::get('/logout', [AuthorizationController::class, 'logout'])->middleware('auth');

