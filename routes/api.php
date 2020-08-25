<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:api', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::resource('packages', 'API\PackageApiController');
    Route::resource('services', 'API\ServiceApiController');
    Route::resource('expanses', 'API\ExpanseApiController');
    Route::resource('customers', 'API\CustomerApiController');

    // SEARCH SELECT2
    Route::get('services/search/select', 'API\ServiceApiController@loadDataSearchReq');
    
});

