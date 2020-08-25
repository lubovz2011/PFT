<?php


namespace App\Http\Controllers;


use App\Classes\Requests\IsraelBank\Otsar;
use App\Classes\Requests\IsraelBank\ProviderFactory;
use App\Models\Account;
use App\Models\Rate;
use App\Models\Transaction;
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
        return view('accounts', [
            'groups'    => array_filter($groups),
            'balance'   => $this->totalBalance($user->currency, collect($groups[Account::TYPE_CASH])),
            'currency'  => $user->currency
        ]);
    }

    public function updateAccount(Request $request)
    {
        $this->validate($request, [
            'id' => 'bail|required|integer|exists:accounts,id'
        ]);
        $id = $request->input('id');
        $this->validate($request, [
            "a-$id-title"     => 'bail|required|string|max:255'
        ]);
        /** @var User $user */
        $user = auth()->user();
        $account = $user->accounts()->where('accounts.id', $id)->firstOrFail();
        $account->title = $request->input("a-$id-title");
        $account->status = $request->input("a-$id-status") == 'on';
        $account->save();
        return redirect()->back();
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

    public function connectDigitalAccount(Request $request)
    {
        /** @var User $user */
        $user = auth()->user();
        $this->validate($request, [
            'bank'      => 'bail|required|in:otsar',
            'username'   => 'bail|required|string',
            'password'  => 'bail|required|string'
        ]);

        try{
            DB::beginTransaction();
            $account = new Account();
            $account->title = $request->input('bank');
            $account->balance = 0;
            $account->currency = $user->currency;
            $account->credentials = json_encode([
                'username' => $request->input('username'),
                'password' => $request->input('password'),
                'bank'     => $request->input('bank')
            ]);
            $user->accounts()->save($account);

            /** @var Otsar $provider */
            $provider = ProviderFactory::provider($request->input('bank'));
            $provider->setAccount($account);
            $provider->send();
            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
        }
        return redirect()->route('accounts');
    }

    public function totalBalance(string $userCurrency, $accounts = null)
    {
        $groupByCurrency = $accounts->groupBy('currency');
        $total = 0;
        foreach ($groupByCurrency as $currency => $accounts){
            $totalByCurrency = 0;
            foreach ($accounts as $account)
                /** @var Account $account */
                $totalByCurrency += $account->balance;
            $total += Rate::convert($totalByCurrency, $currency, $userCurrency);
        }
        return number_format($total, 2, '.', ',');
    }

}
