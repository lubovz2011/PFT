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
    $transactionsByDate = [
        date("d/m/Y l") => [
            ["id" => 1, "amount" => number_format(-25, 2, '.', ','), "currency" => "ILS", "categoryName" => "Books", "categoryIcon" => "fas fa-user-graduate"],
            ["id" => 2, "amount" => number_format(-75.10, 2, '.', ','), "currency" => "ILS", "categoryName" => "Internet", "categoryIcon" => "fas fa-file-invoice-dollar"],
            ["id" => 3, "amount" => number_format(5, 2, '.', ','), "currency" => "ILS", "categoryName" => "Bonus", "categoryIcon" => "fas fa-hand-holding-usd"]
        ]
    ];
    return view('transactions', ["transactionsByDate" => $transactionsByDate]);
})->name('transactions');


