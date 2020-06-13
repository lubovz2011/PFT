<?php


namespace App\Http\Controllers;


use App\Models\Account;
use App\Models\User;

class AccountsController extends Controller
{
    /**
     * method returns accounts page
     * @return \Illuminate\View\View
     */
    public function displayAccountsPage(){
        /** @var User $user */
        $user = auth()->user();

        /** @var Account[] $accounts */
        $accounts = $user->accounts->all();
        $groups = [Account::TYPE_CASH => [], Account::TYPE_CARD => []];

        foreach ($accounts as $account){
            if($account->type == Account::TYPE_CASH)
                $groups[Account::TYPE_CASH][] = $account;
            else
                $groups[Account::TYPE_CARD][] = $account;
        }
        return view('accounts', ['groups' => array_filter($groups)]);
    }
}
