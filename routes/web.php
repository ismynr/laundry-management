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
    Route::resource('profile', 'admin\ProfileController');
    Route::resource('activity-log', 'admin\ActivityLogController');

    Route::get('transactions/{id}/claim', 'admin\TransactionController@claimTransaction')->name('transactions.claimTransaction');
    Route::get('transaction/{id}/invoice', 'admin\TransactionController@generateInvoice')->name('transactions.invoice');
    Route::post('transaction/{id}/invoice/mark', 'admin\TransactionController@generateMark')->name('transactions.invoice.mark');
    Route::get('transaction-details/get/mark', 'admin\TransactionDetailController@indexMark')->name('transaction-details.indexMark');
    
    Route::get('expanses/get/your_expanses', 'admin\ExpanseController@indexOwner')->name('expanses.indexOwner');
    Route::get('users/get/karyawan_users', 'admin\UserController@indexKaryawan')->name('users.indexKaryawan');
});

/**
 * 
 * Middleware Auth Karyawan
 */
Route::middleware(['auth', 'karyawan', 'verified'])->prefix('karyawan')->name('karyawan.')->group(function (){
    Route::get('/home', 'KaryawanController@index')->name('dashboard');
    Route::resource('expanses', 'karyawan\ExpanseController');
    Route::resource('customers', 'karyawan\CustomerController');
    Route::resource('profile', 'karyawan\ProfileController');
    Route::resource('transactions', 'karyawan\TransactionController');
    Route::resource('transaction-details', 'karyawan\TransactionDetailController');
    Route::get('packages', 'karyawan\PackageController@index')->name('packages.index');

    Route::get('transactions/{id}/claim', 'karyawan\TransactionController@claimTransaction')->name('transactions.claimTransaction');
    Route::get('transaction/{id}/invoice', 'karyawan\TransactionController@generateInvoice')->name('transactions.invoice');
    Route::post('transaction/{id}/invoice/mark', 'karyawan\TransactionController@generateMark')->name('transactions.invoice.mark');
    Route::get('transaction-details/get/mark', 'karyawan\TransactionDetailController@indexMark')->name('transaction-details.indexMark');

    Route::put('profile/{id}/karyawan/update', 'karyawan\ProfileController@updateKaryawan')->name('profile.dataKaryawan.update');
    Route::get('expanses/get/your_expanses', 'karyawan\ExpanseController@indexOwner')->name('expanses.indexOwner');
    
});
