<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:api', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::resource('packages', 'API\PackageApiController');
    Route::resource('services', 'API\ServiceApiController');
    Route::resource('expanses', 'API\ExpanseApiController');
    Route::resource('customers', 'API\CustomerApiController');
    Route::resource('users', 'API\UserApiController');
    Route::resource('karyawans', 'API\KaryawanApiController');

    // USERS FILTER ROLE
    Route::get('users/admin/get', 'API\UserApiController@indexAdmin');
    Route::get('users/karyawan/get', 'API\UserApiController@indexKaryawan');

    // SEARCH SELECT2
    Route::get('services/search/select', 'API\ServiceApiController@loadDataSearchReq');
    
});

