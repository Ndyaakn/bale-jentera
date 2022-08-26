<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('api')->group(function()
{
    
   Route::post('login', 'ApiAuthenticationController@login');
   
//   Route::middleware('jwt.auth')->group(function() {
       
        Route::get('logout', 'ApiAuthenticationController@logout');
        Route::get('menu', 'ApiMenuController@index');
        Route::get('menu-search', 'ApiMenuController@menuSearch');
        Route::get('menu-paginate', 'ApiMenuController@indexPaginate');
        Route::get('table', 'ApiMenuController@indexTable');
        Route::post('menu', 'ApiMenuController@store');
        Route::get('menu/{id}', 'ApiMenuController@edit');
        Route::post('menu/{id}/edit-stock', 'ApiMenuController@update');
        Route::post('menu/{id}/edit-menu', 'ApiMenuController@updateMenu');
        Route::post('menu/{id}/delete', 'ApiMenuController@delete');
        Route::get('menu/kategori-pesanan', 'ApiMenuController@orderCategory');
        Route::get('kategori-order', 'ApiOrderController@orderCategory');
        Route::get('kategori-menu', 'ApiCategoryMenuController@index');
        Route::post('kategori-menu', 'ApiCategoryMenuController@store');
        Route::get('bahan', 'ApiMaterialController@index');
        Route::post('bahan', 'ApiMaterialController@store');
        Route::post('bahan/{id}/edit', 'ApiMaterialController@edit');
        Route::post('bahan/{id}', 'ApiMaterialController@update');
        Route::post('bahan/{id}/stok', 'ApiMaterialController@updateStock');
        Route::get('bahan-menu', 'ApiMaterialMenuController@index');
        Route::post('bahan-menu', 'ApiMaterialMenuController@store');
        Route::post('bahan-menu/{id}/edit', 'ApiMaterialMenuController@edit');
        Route::post('bahan-menu/{id}', 'ApiMaterialMenuController@update');
        Route::get('list-bill', 'ApiBillController@index');
        Route::post('order-update-status', 'ApiBillController@updatestatus');
        Route::get('order/{id}/edit', 'ApiOrderController@edit');
        Route::post('order/{id}', 'ApiOrderController@update');
//   });
        Route::post('order', 'ApiOrderController@store');
   
});
