<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');

Route::middleware('auth')->group(function () {
Route::resource('companies', CompanyController::class)->except(['index']);
Route::resource('users', UserController::class);
    Route::middleware('role:super')->group(function () {
        
    });
});