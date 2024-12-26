<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home',[BerandaController::class, 'berandaBackend'])->name('backend.beranda')->middleware('auth');

// Login
Route::get('/login',[LoginController::class,'loginBackend'])->name('backend.login');
Route::post('/login',[LoginController::class,'authenticateBackend'])->name('backend.login');
Route::get('/logout',[LoginController::class,'logoutBackend'])->name('backend.logout');