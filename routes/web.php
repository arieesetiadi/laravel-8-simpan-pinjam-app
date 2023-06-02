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
     * KELOLA DIREKTUR
     */
    Route::prefix('/direktur')->middleware('auth.any')->group(function () {
        Route::get('/', 'halamanUtamaDirektur')->name('halamanUtamaDirektur');
        Route::get('/tambah', 'halamanTambahDirektur')->name('halamanTambahDirektur');
        Route::post('/tambah', 'prosesTambahDirektur')->name('prosesTambahDirektur');
        Route::get('/detail/{id}', 'halamanDetailDirektur')->name('halamanDetailDirektur');
        Route::get('/ubah/{id}', 'halamanUbahDirektur')->name('halamanUbahDirektur');
        Route::put('/ubah/{id}', 'prosesUbahDirektur')->name('prosesUbahDirektur');
        Route::get('/hapus/{id}', 'prosesHapusDirektur')->name('prosesHapusDirektur');
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

    /**
     * KELOLA NO TABUNGAN
     */
    Route::prefix('/no-tabungan')->middleware('auth.any')->group(function () {
        Route::get('/', 'halamanUtamaNoTabungan')->name('halamanUtamaNoTabungan');
        Route::get('/tambah', 'halamanTambahNoTabungan')->name('halamanTambahNoTabungan');
        Route::post('/tambah', 'prosesTambahNoTabungan')->name('prosesTambahNoTabungan');
        Route::get('/detail/{id}', 'halamanDetailNoTabungan')->name('halamanDetailNoTabungan');
        Route::get('/hapus/{id}', 'prosesHapusNoTabungan')->name('prosesHapusNoTabungan');
    });

    /**
     * KELOLA KAS SIMPANAN
     */
    Route::prefix('/kas-simpanan')->middleware('auth.any')->group(function () {
        Route::get('/', 'halamanUtamaKasSimpanan')->name('halamanUtamaKasSimpanan');
        Route::get('/tambah', 'halamanTambahKasSimpanan')->name('halamanTambahKasSimpanan');
        Route::get('/tarik', 'halamanTarikKasSimpanan')->name('halamanTarikKasSimpanan');
        Route::post('/tambah', 'prosesTambahKasSimpanan')->name('prosesTambahKasSimpanan');
        Route::post('/tarik', 'prosesTarikKasSimpanan')->name('prosesTarikKasSimpanan');
        Route::get('/detail/{id}', 'halamanDetailKasSimpanan')->name('halamanDetailKasSimpanan');
    });

    /**
     * KELOLA NO PINJAMAN
     */
    Route::prefix('/no-pinjaman')->middleware('auth.any')->group(function () {
        Route::get('/', 'halamanUtamaNoPinjaman')->name('halamanUtamaNoPinjaman');
        Route::get('/tambah', 'halamanTambahNoPinjaman')->name('halamanTambahNoPinjaman');
        Route::post('/tambah', 'prosesTambahNoPinjaman')->name('prosesTambahNoPinjaman');
        Route::get('/detail/{id}', 'halamanDetailNoPinjaman')->name('halamanDetailNoPinjaman');
        Route::get('/hapus/{id}', 'prosesHapusNoPinjaman')->name('prosesHapusNoPinjaman');
    });

    /**
     * KELOLA PINJAMAN
     */
    Route::prefix('/pinjaman')->middleware('auth.any')->group(function () {
        Route::get('/', 'halamanUtamaPinjaman')->name('halamanUtamaPinjaman');
        Route::get('/tambah', 'halamanTambahPinjaman')->name('halamanTambahPinjaman');
        Route::post('/tambah', 'prosesTambahPinjaman')->name('prosesTambahPinjaman');
        Route::get('/detail/{id}', 'halamanDetailPinjaman')->name('halamanDetailPinjaman');
    });
});
