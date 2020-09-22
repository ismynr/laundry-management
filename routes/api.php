<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:api', 'admin'])->prefix('admin')->name('api.admin.')->group(function () {
    Route::resource('users', 'API\UserApiController');
    Route::resource('packages', 'API\PackageApiController');
    Route::resource('services', 'API\ServiceApiController');
    Route::resource('expanses', 'API\ExpanseApiController');
    Route::resource('customers', 'API\CustomerApiController');
    Route::resource('karyawans', 'API\KaryawanApiController');
    Route::resource('transactions', 'API\TransactionApiController');
    Route::resource('transaction-details', 'API\TransactionDetailApiController');
    
    Route::put('transaction-details/update-status/{id}', 'API\TransactionDetailApiController@updateStatus');
    Route::delete('transaction-details/delete-by-idtrans/{id}', 'API\TransactionDetailApiController@destroyByIdTrans');

    // USERS FILTER ROLE
    Route::get('users/admin/get', 'API\UserApiController@indexAdmin');
    Route::get('users/karyawan/get', 'API\UserApiController@indexKaryawan');

    // SEARCH SELECT2
    Route::get('services/search/select', 'API\ServiceApiController@loadDataSearchReq');
    Route::get('customers/search/select', 'API\CustomerApiController@loadDataSearchReq');
});

Route::middleware(['auth:api', 'karyawan'])->prefix('karyawan')->name('api.karyawan.')->group(function () {
    Route::resource('expanses', 'API\karyawan\ExpanseApiController');
    Route::resource('customers', 'API\karyawan\CustomerApiController');
    Route::resource('transactions', 'API\karyawan\TransactionApiController');
    Route::resource('transaction-details', 'API\karyawan\TransactionDetailApiController');

    Route::put('transaction-details/update-status/{id}', 'API\karyawan\TransactionDetailApiController@updateStatus');
    Route::delete('transaction-details/delete-by-idtrans/{id}', 'API\karyawan\TransactionDetailApiController@destroyByIdTrans');

    // SEARCH SELECT2
    Route::get('customers/search/select', 'API\CustomerApiController@loadDataSearchReq');
});

