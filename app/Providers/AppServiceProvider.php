<?php

namespace App\Providers;

use App\Models\Account;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::created(function($user){
            /** @var User $user */

            /* default account for new user */
            $account = new Account();
            $account->title = 'Wallet';
            $user->accounts()->save($account);

            /* default categories for new user */
            $category = new Category();
            $category->name = 'Bills';
            $category->icon = 'fas fa-file-invoice-dollar';
            $user->categories()->save($category);

            $category = new Category();
            $category->name = 'Tax & Fees';
            $category->icon = 'fas fa-coins';
            $user->categories()->save($category);
        });

    }
}
