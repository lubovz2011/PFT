<?php

namespace App\Providers;

use App\DefaultData\DefaultAccount;
use App\DefaultData\DefaultCategories;
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

            DefaultAccount::generate($user);
            DefaultCategories::generate($user);

        });

    }
}
