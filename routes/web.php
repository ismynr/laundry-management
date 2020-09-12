<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

/**
 * 
 * Middleware Auth Admin
 */
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function (){
    Route::get('/home', 'AdminController@index')->name('dashboard');

    Route::resource('users', 'admin\UserController');
    Route::resource('packages', 'admin\PackageController');
    Route::resource('services', 'admin\ServiceController');
    Route::resource('expanses', 'admin\ExpanseController');
    Route::resource('customers', 'admin\CustomerController');
    Route::resource('transactions', 'admin\TransactionController');
    Route::resource('transaction-details', 'admin\TransactionDetailController');

    Route::post('transactions/add/detail-item', 'admin\TransactionController@addItem')->name('transactions.addItem');
    
    Route::get('expanses/get/your_expanses', 'admin\ExpanseController@indexOwner')->name('expanses.indexOwner');
    Route::get('users/get/karyawan_users', 'admin\UserController@indexKaryawan')->name('users.indexKaryawan');
});

/**
 * 
 * Middleware Auth Karyawan
 */
Route::middleware(['auth', 'karyawan', 'verified'])->prefix('karyawan')->name('karyawan.')->group(function (){
    Route::get('/home', 'KaryawanController@index')->name('dashboard');

    
});
