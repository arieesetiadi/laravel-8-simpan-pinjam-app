<?php

use App\Http\Controllers\ActionController;
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

Route::controller(ActionController::class)->group(function () {
    Route::get('/login', 'halamanLogin')->name('halamanLogin');
    Route::post('/login', 'prosesLogin')->name('prosesLogin');
    Route::get('/logout', 'prosesLogout')->name('prosesLogout')->middleware('auth.any');

    Route::get('/', 'halamanDashboard')->name('halamanDashboard')->middleware('auth.any');

    /**
     * KELOLA PEGAWAI
     */
    Route::prefix('/pegawai')->middleware('auth.any')->group(function () {
        Route::get('/', 'halamanUtamaPegawai')->name('halamanUtamaPegawai');
        Route::get('/detail/{id}', 'halamanDetailPegawai')->name('halamanDetailPegawai');
        Route::get('/tambah', 'halamanTambahPegawai')->name('halamanTambahPegawai');
        Route::get('/ubah/{id}', 'halamanUbahPegawai')->name('halamanUbahPegawai');
        Route::post('/tambah', 'prosesTambahPegawai')->name('prosesTambahPegawai');
        Route::post('/ubah', 'prosesUbahPegawai')->name('prosesUbahPegawai');
    });
});
