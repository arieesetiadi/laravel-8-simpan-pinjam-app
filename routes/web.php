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
    Route::get('/profile', 'halamanProfile')->name('halamanProfile')->middleware('auth.any');
    Route::post('/profile/ubah', 'prosesUbahProfile')->name('prosesUbahProfile')->middleware('auth.any');

    /**
     * KELOLA PENGAWAS
     */
    Route::prefix('/pengawas')->middleware('auth.any')->group(function () {
        Route::get('/', 'halamanUtamaPengawas')->name('halamanUtamaPengawas');
        Route::get('/tambah', 'halamanTambahPengawas')->name('halamanTambahPengawas');
        Route::post('/tambah', 'prosesTambahPengawas')->name('prosesTambahPengawas');
        Route::get('/detail/{id}', 'halamanDetailPengawas')->name('halamanDetailPengawas');
        Route::get('/ubah/{id}', 'halamanUbahPengawas')->name('halamanUbahPengawas');
        Route::put('/ubah/{id}', 'prosesUbahPengawas')->name('prosesUbahPengawas');
        Route::get('/hapus/{id}', 'prosesHapusPengawas')->name('prosesHapusPengawas');
    });

    /**
     * KELOLA PEGAWAI
     */
    Route::prefix('/pegawai')->middleware('auth.any')->group(function () {
        Route::get('/', 'halamanUtamaPegawai')->name('halamanUtamaPegawai');
        Route::get('/tambah', 'halamanTambahPegawai')->name('halamanTambahPegawai');
        Route::post('/tambah', 'prosesTambahPegawai')->name('prosesTambahPegawai');
        Route::get('/detail/{id}', 'halamanDetailPegawai')->name('halamanDetailPegawai');
        Route::get('/ubah/{id}', 'halamanUbahPegawai')->name('halamanUbahPegawai');
        Route::put('/ubah/{id}', 'prosesUbahPegawai')->name('prosesUbahPegawai');
        Route::get('/hapus/{id}', 'prosesHapusPegawai')->name('prosesHapusPegawai');
    });

    /**
     * KELOLA TIM VERIFIKASI
     */
    Route::prefix('/tim-verifikasi')->middleware('auth.any')->group(function () {
        Route::get('/', 'halamanUtamaTim')->name('halamanUtamaTim');
        Route::get('/tambah', 'halamanTambahTim')->name('halamanTambahTim');
        Route::post('/tambah', 'prosesTambahTim')->name('prosesTambahTim');
        Route::get('/detail/{id}', 'halamanDetailTim')->name('halamanDetailTim');
        Route::get('/ubah/{id}', 'halamanUbahTim')->name('halamanUbahTim');
        Route::put('/ubah/{id}', 'prosesUbahTim')->name('prosesUbahTim');
        Route::get('/hapus/{id}', 'prosesHapusTim')->name('prosesHapusTim');
    });

     /**
     * KELOLA NASABAH
     */
    Route::prefix('/nasabah')->middleware('auth.any')->group(function () {
        Route::get('/', 'halamanUtamaNasabah')->name('halamanUtamaNasabah');
        Route::get('/tambah', 'halamanTambahNasabah')->name('halamanTambahNasabah');
        Route::post('/tambah', 'prosesTambahNasabah')->name('prosesTambahNasabah');
        Route::get('/detail/{id}', 'halamanDetailNasabah')->name('halamanDetailNasabah');
        Route::get('/ubah/{id}', 'halamanUbahNasabah')->name('halamanUbahNasabah');
        Route::put('/ubah/{id}', 'prosesUbahNasabah')->name('prosesUbahNasabah');
        Route::get('/hapus/{id}', 'prosesHapusNasabah')->name('prosesHapusNasabah');
    });
});
