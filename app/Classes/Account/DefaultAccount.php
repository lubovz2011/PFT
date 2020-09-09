<?php


namespace App\Classes\Account;

use App\Classes\Defaults;
use App\Models\Account;
use App\Models\User;

/**
 * Class DefaultAccount
 * This class contains methods that allow us set defaults for user accounts
 *
 * @package App\Classes\Account
 */
class DefaultAccount extends Defaults
{
    /**
     * Static method generate default account
     * @param User $user
     */
    public static function generate(User $user)
    {
        $account = new Account();
        $account->title = 'Wallet';
        $user->accounts()->save($account);
    }
}
