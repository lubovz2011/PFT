<?php


namespace App\Http\Controllers;


use App\Classes\Requests\AbstractRequest;
use App\Helpers\Helpers;
use App\Models\Account;
use App\Models\Rate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class AccountsController
 * This class handle user commands on accounts
 *
 * @package App\Http\Controllers
 */
class AccountsController extends Controller
{
    /**
     * Method returns accounts page
     * @return \Illuminate\View\View
     */
    public function displayAccountsPage()
    {
        /** @var User $user */
        $user = auth()->user();
        $groups = $user->accounts->groupBy('type');

        return view('accounts', [
            'groups'    => $groups,
            'currency'  => $user->currency
        ]);
    }

    /**
     * Method update existing account and redirect user back
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
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
     * Method delete account and redirect user back
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
        return redirect()->back();
    }

    /**
     * Method create cash account and redirect user back
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function createCashAccount(Request $request)
    {
        /** @var User $user */
        $user = auth()->user();
        $this->validate($request, [
           'title'    => 'bail|required|string|max:255',
           'balance'  => 'bail|required|numeric|between:-999999.99,999999.99',
           'currency' => 'bail|required|in:ILS,USD,EUR,GBP,JPY'
        ]);
        $account = new Account();
        $account->title = $request->input('title');
        $account->balance = $request->input('balance');
        $account->currency = $request->input('currency');
        $user->accounts()->save($account);
        return redirect()->back();
    }

    /**
     * Method create digital account and redirect user back
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function connectDigitalAccount(Request $request)
    {
        /** @var User $user */
        $user = auth()->user();
        $this->connectDigitalAccountValidation($request);

        try{
            DB::beginTransaction();
            $account = new Account();
            $account->title = $request->input('bank');
            $account->type = Account::TYPE_CARD;
            $account->balance = 0;
            $account->currency = $user->currency;
            $account->credentials = json_encode([
                'username' => encrypt($request->input('username')),
                'password' => encrypt($request->input('password')),
                'bank'     => $request->input('bank')
            ]);
            $user->accounts()->save($account);
            AbstractRequest::provider($request->input('bank'))->setAccount($account)->send();
            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
        }
        return redirect()->back();
    }

    /**
     * Method validate request data for digital account connection
     * @param Request $request
     * @throws \Illuminate\Validation\ValidationException
     */
    private function connectDigitalAccountValidation(Request $request){
        $this->validate($request, [
            'bank'      => 'bail|required|in:otsar',
            'username'   => 'bail|required|string',
            'password'  => 'bail|required|string'
        ]);
    }

    /**
     * Method synchronize with digital account
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function synchronizeAccount(Request $request)
    {
        /** @var User $user */
        $user = auth()->user();
        /** @var Account $account */
        $account = $user->accounts()->where('id', '=', $request->input('id'))->firstOrFail();

        if($account->type == Account::TYPE_CARD){
            $credentials = json_decode($account->credentials);
            try{
                DB::beginTransaction();
                AbstractRequest::provider($credentials->bank)->setAccount($account)->send();
                DB::commit();
            }
            catch (\Exception $e) {
                DB::rollBack();
                abort(500, "Ops, something went wrong.. Please, try again later.");
            }
        }
        else{
            abort(403, "Invalid type of account. Can't update this account.");
        }
        return response()->json($account);
    }

    /**
     * Method return total balance of accounts
     * @param string $userCurrency
     * @param null $accounts
     * @return string
     */
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
        return Helpers::NumberFormat($total);
    }
}
