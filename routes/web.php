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
    Route::get('/login', 'tampilLogin')->name('tampilLogin');
    Route::post('/login', 'prosesLogin')->name('prosesLogin');

    Route::get('/', 'tampilDashboard')->name('tampilDashboard')->middleware('auth.any');
});
