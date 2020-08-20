<?php

namespace App\Providers;


use App\Classes\Account\DefaultAccount;
use App\Classes\Category\DefaultCategories;
use App\Classes\Requests\SaltEdge\Customer\CreateCustomer;
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
            (new CreateCustomer())->setUser($user)->send();
        });

    }
}
