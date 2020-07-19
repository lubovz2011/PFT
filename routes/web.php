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



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::group(['middleware' => 'guest'], function(){
    /** index page */
    Route::get('/', 'PagesController@displayWelcomePage')->name('welcome');
    /** url for login user using social network login (Oath)*/
    Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider')->name('social-login');
    /** Oath callback from social network */
    Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('social-login-callback');
});

Route::group(['middleware' => 'auth'], function(){

    /** categories page */
    Route::get('categories', 'CategoriesController@displayCategoriesPage')->name('categories');

    Route::post('categories/change-status', 'CategoriesController@changeStatus')->name('change-status');
    /** accounts page */
    Route::get('accounts', 'AccountsController@displayAccountsPage')->name('accounts');
    /** transactions page */
    Route::get('transactions','TransactionsController@displayTransactionsPage')->name('transactions');
    /** reports page */
    Route::get('reports', 'ReportsController@displayReportsPage')->name('reports');

    Route::post('accounts/delete-account', 'AccountsController@deleteAccount')->name('delete-account');

    Route::post('accounts/create-cash-account', 'AccountsController@createCashAccount')->name('create-cash-account');

    Route::post('categories/delete-category', 'CategoriesController@deleteCategory')->name('delete-category');

    Route::post('categories/add-category', 'CategoriesController@addCategory')->name('add-category');

    /** user settings routes */
    Route::group(['prefix' => 'settings', 'as' => 'settings'], function()
    {
        Route::get('/', 'UserController@displaySettingsPage');

        Route::post('personal-info', 'UserController@editPersonalInfo')->name(':personal-info');

        Route::post('delete-profile', 'UserController@deleteProfile')->name(':delete-profile');

        Route::post('interface', 'UserController@editInterface')->name(':interface');

        Route::post('security', 'UserController@editSecurity')->name(':security');

        Route::post('email-notifications', 'UserController@editEmailNotifications')->name(':email-notifications');
    });
});

