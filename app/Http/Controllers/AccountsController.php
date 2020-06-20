<?php


namespace App\Http\Controllers;


use App\Models\Account;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountsController extends Controller
{
    /**
     * ToDo: empty table for empty accounts
     * method returns accounts page
     * @return \Illuminate\View\View
     */
    public function displayAccountsPage()
    {
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

    /**
     * ToDo: validate request
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function deleteAccount(Request $request)
    {
        /** @var User $user */
        $user = auth()->user();
        $accountId = $request->input('id');
        $account = $user->accounts()->where('id', '=', $accountId)->first();
        $account->delete();
        return redirect()->route('accounts');
    }

    public function createCashAccount(Request $request)
    {
        /** @var User $user */
        $user = auth()->user();
        $this->validate($request, [
           'title'    => 'bail|required|string|max:255',
           'balance'  => 'bail|required|numeric',
           'currency' => 'bail|required|in:ILS,USD,EUR,GBP,JPY'
        ]);
        $account = new Account();
        $account->title = $request->input('title');
        $account->balance = $request->input('balance');
        $account->currency = $request->input('currency');
        $user->accounts()->save($account);
        return redirect()->route('accounts');
    }

}
