<?php


namespace App\DefaultData;


use App\Models\Account;
use App\Models\User;

class DefaultAccount extends Defaults
{
    /**
     * generate default account for new user
     * @param User $user
     */
    public static function generate(User $user)
    {
        $account = new Account();
        $account->title = 'Wallet';
        $user->accounts()->save($account);
    }

}
