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
    Route::get('/', 'AdminController@index')->name('dashboard');

    Route::resource('packages', 'admin\PackageController');
    Route::resource('services', 'admin\ServiceController');
    Route::resource('expanses', 'admin\ExpanseController');
    Route::resource('customers', 'admin\CustomerController');
    Route::get('expanses/owner/get', 'admin\ExpanseController@indexOwner')->name('expanses.indexOwner');
});

/**
 * 
 * Middleware Auth Karyawan
 */
Route::middleware(['auth', 'karyawan', 'verified'])->prefix('karyawan')->name('karyawan.')->group(function (){
    Route::get('/', 'KaryawanController@index')->name('dashboard');

    
});
