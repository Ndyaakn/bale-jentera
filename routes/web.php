<?php

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

// Route::get('/desain-page', function () {
//     return view('dashboard-admin.admin-management.index');
// });

Route::get('/menu', function () {
    return view('user.index');
});

Route::get('/refresh-storage', function () {
Artisan::call('storage:link');
});

Route::get('admin-login', 'AuthenticationController@index');
Route::post('admin-login', 'AuthenticationController@signIn')->name('login');

Route::middleware('auth')->group(function() {
    Route::get('sign-out', 'AuthenticationController@signOut')->name('signOut');

    Route::get('home', 'HomeController@index')->name('home');
    Route::resource('manajemen-pelayan', 'WaitressController');
    Route::post('ubah-kata-sandi/{id}', 'WaitressController@updatePassword');
    Route::resource('manajemen-meja', 'TableController');
    Route::resource('manajemen-kategori-menu', 'CategoryMenuController');
    Route::resource('manajemen-menu', 'MenuController');
    Route::resource('manajemen-bahan', 'MaterialController');
    Route::resource('bahan-menu', 'MaterialMenuController');
    Route::resource('laporan-keuangan', 'FinancialStatementTitleController');
    Route::post('kurang-stok', 'FinancialStatementTitleController@decreaseStock');
    Route::resource('riwayat-aktivitas', 'ActivityHistoryController');
    Route::resource('jurnal', 'JournalOrderController');
    Route::resource('detail-jurnal', 'OrderController');
    Route::get('/export', 'JournalOrderController@export');
    
});

Route::resource('', 'ListMenuController');
