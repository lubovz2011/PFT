<?php

namespace App\Providers;

use App\Models\Account;
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
            $account = new Account();
            $account->title = 'Wallet';
            $user->accounts()->save($account);
        });
    }
}
