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

/** index page */
Route::get('/', 'PagesController@displayWelcomePage')->name('welcome');
/** user settings */
Route::get('settings', 'UserController@displaySettingsPage')->name('settings');
/** categories page */
Route::get('categories', 'CategoriesController@displayCategoriesPage')->name('categories');
/** accounts page */
Route::get('accounts', 'AccountsController@displayAccountsPage')->name('accounts');
/** transactions page */
Route::get('transactions','TransactionsController@displayTransactionsPage')->name('transactions');
/** reports page */
Route::get('reports', 'ReportsController@displayReportsPage')->name('reports');
