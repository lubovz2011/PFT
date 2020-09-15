<?php

namespace App\Providers;


use App\Classes\Account\DefaultAccount;
use App\Classes\Category\DefaultCategories;
use App\Classes\Requests\SaltEdge\Customer\CreateCustomer;
use App\Models\User;
use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider
 * @package App\Providers
 */
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
        //when user created - run following cod
        User::created(function($user)
        {
            /** @var User $user */
            DefaultAccount::generate($user);
            DefaultCategories::generate($user);
        });
    }
}
