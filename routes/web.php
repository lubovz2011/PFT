<?php

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
    return view('index');
})->name('welcome');

Route::get('settings', function(){
   return view('settings');
})->name('settings');

Route::get('categories', function(){
   return view('categories');
})->name('categories');

Route::get('accounts', function(){
   return view('accounts');
})->name('accounts');

Route::get('transactions', function(){
    return view('transactions');
})->name('transactions');


