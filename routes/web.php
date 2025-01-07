<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\DetailPesananController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProsesPesananController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// Beranda
Route::get('/home',[BerandaController::class, 'berandaBackend'])->name('backend.beranda')->middleware('auth');

// Login
Route::get('/login',[LoginController::class,'loginBackend'])->name('backend.login');
Route::post('/login',[LoginController::class,'authenticateBackend'])->name('backend.login');
Route::get('/logout',[LoginController::class,'logoutBackend'])->name('backend.logout');

// User
Route::resource('/user',UserController::class, ['as'=>'backend'])->middleware('auth');
Route::get('profile', [UserController::class, 'profil'])->name('profile')->middleware('auth');


// Kategori
Route::resource('/kategori',KategoriController::class, ['as'=>'backend'])->middleware('auth');

// Menu
Route::resource('/menu',MenuController::class, ['as'=>'backend'])->middleware('auth');

// Pesanan
Route::resource('/pesanan',PesananController::class, ['as'=>'backend'])->middleware('auth');
Route::get('/pesanan/{id}/create', [PesananController::class, 'tambahTransaksi'])->name('backend.pesanan.tambahTransaksi')->middleware('auth');
Route::delete('/pesanan/{id}/delete', [PesananController::class, 'delete'])->name('pesanan.destroy')->middleware('auth');
Route::put('/pesanan/{id}/update', [PesananController::class, 'update'])->name('pesanan.update')->middleware('auth');
Route::get('/pesanan/{id}/hitung', [PesananController::class, 'hitungPembayaran'])->name('pesanan.hitung')->middleware('auth');
Route::get('/laporan/transaksi',[PesananController::class,'form'])->name('laporan.form')->middleware('auth');
Route::post('/laporan/transaksi/cetak',[PesananController::class,'cetak'])->name('laporan.cetak')->middleware('auth');

// Proses Pesanan
Route::resource('/proses',ProsesPesananController::class, ['as'=>'backend'])->middleware('auth');
Route::get('/detail-pesanan/selesai/{id}', [ProsesPesananController::class, 'done'])->name('detail-pesanan.selesai')->middleware('auth');

// Detail
Route::post('/pesanan/detail/create',[DetailPesananController::class, 'store'])->name('detail.pesanan')->middleware('auth');
Route::delete('/detail-pesanan/{id}', [DetailPesananController::class, 'delete'])->name('detail-pesanan.delete')->middleware('auth');
Route::get('/laporan/pesanan',[DetailPesananController::class,'formPesanan'])->name('laporan.formpesan')->middleware('auth');
Route::post('/laporan/pesanan/cetak',[DetailPesananController::class,'cetakPesanan'])->name('laporan.cetakpesan')->middleware('auth');
