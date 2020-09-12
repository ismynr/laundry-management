<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:api', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', 'API\UserApiController');
    Route::resource('packages', 'API\PackageApiController');
    Route::resource('services', 'API\ServiceApiController');
    Route::resource('expanses', 'API\ExpanseApiController');
    Route::resource('customers', 'API\CustomerApiController');
    Route::resource('karyawans', 'API\KaryawanApiController');
    Route::resource('transactions', 'API\TransactionApiController');
    Route::resource('transaction-details', 'API\TransactionDetailApiController');
    Route::put('transaction-details/update-status/{id}', 'API\TransactionDetailApiController@updateStatus');


    // USERS FILTER ROLE
    Route::get('users/admin/get', 'API\UserApiController@indexAdmin');
    Route::get('users/karyawan/get', 'API\UserApiController@indexKaryawan');

    // SEARCH SELECT2
    Route::get('services/search/select', 'API\ServiceApiController@loadDataSearchReq');
    Route::get('customers/search/select', 'API\CustomerApiController@loadDataSearchReq');
    
});

