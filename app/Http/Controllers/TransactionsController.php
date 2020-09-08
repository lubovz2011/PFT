<?php


namespace App\Http\Controllers;


use App\Models\Account;
use App\Models\Category;
use App\Models\Rate;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Doctrine\DBAL\Query\QueryBuilder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class TransactionsController extends Controller
{
    /**
     * method return transactions page
     * @return \Illuminate\View\View
     */
    public function displayTransactionsPage(Request $request)
    {
        /** @var User $user */
        $user = auth()->user();
        /** @var Account[] $accounts */
        $accounts = $user->accounts;
        /** @var Category[] $categories */
        $categories = $user->categories()->whereNull('parent_id')->where('status', 1)
                                         ->with(['categories' => function($query){
                                             $query->where('status', 1);
                                         }])->get();
        $transactions = $user->transactions();
        $this->attachFilterTimesToQuery($transactions, $request);
        $transactions = $this->attachFiltersToQuery($transactions, $request)
                             ->with('category')
                             ->with('account')
                             ->orderBy('date', 'desc')
                             ->orderBy('id', 'desc')
                             ->paginate($user->limit);
        $transactions->appends($request->all());

        if($transactions->currentPage() > $transactions->lastPage())
            return redirect()->route('transactions', ['page' => $transactions->lastPage()]);

        return view('transactions', [
            'paginator'          => $transactions,
            'totalBalance'       => $this->totalBalance($user->currency, $user->accounts),
            'currency'           => $user->currency,
            'accounts'           => $accounts,
            'categories'         => $categories
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function addTransaction(Request $request)
    {
        $this->validate($request, [
            'type'        => 'required|in:income,expense',
            'account'     => 'bail|required|integer',
            'category'    => 'bail|required|integer|exists:categories,id',
            'date'        => 'bail|required|date',
            'amount'      => 'bail|required|numeric',
            'description' => 'bail|max:1024'
        ]);
        /** @var User $user */
        $user = auth()->user();
        /** @var Account $account */
        $account = $user->accounts()->where('id', '=', $request->input('account'))->firstOrFail();
        /** @var Category $category */
        $category = $user->categories()->where('id', '=', $request->input('category'))->firstOrFail();

        $transaction = new Transaction();
        $transaction->type = $request->input('type');
        $transaction->account_id = $request->input('account');
        $transaction->category_id = $request->input('category');
        $transaction->amount = abs($request->input('amount'));
        $transaction->currency = $account->currency;
        $transaction->date = $request->input('date');
        $transaction->description = $request->input('description') ?? '';
        $transaction->save();
        $account->balance += $transaction->amount;
        $account->save();
        return redirect()->route('transactions');
    }

    /**
     * ToDo: validate request
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function deleteTransaction(Request $request)
    {
        $this->validate($request, [
            'id' => 'bail|required|integer|exists:transactions,id'
        ]);
        /** @var User $user */
        $user = auth()->user();
        $transaction = $user->transactions()->where('transactions.id', '=', $request->input('id'))->first();
        $account = $transaction->account;
        $account->balance -= $transaction->amount;
        $account->save();
        $transaction->delete();
        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateTransaction(Request $request)
    {
        $this->validate($request, [
            'id' => 'bail|required|integer|exists:transactions,id'
        ]);
        $id = $request->input('id');
        $this->validate($request, [
            "t-$id-type"        => 'bail|required|in:income,expense',
            "t-$id-account"     => 'bail|required|integer',
            "t-$id-category"    => 'bail|required|integer|exists:categories,id',
            "t-$id-date"        => 'bail|required|date',
            "t-$id-amount"      => 'bail|numeric',
            "t-$id-description" => 'bail|max:1024'
        ]);
        /** @var User $user */
        $user = auth()->user();
        /** @var Transaction $transaction */
        $transaction = $user->transactions()->where('transactions.id', '=', $id)->first();
        try {
            DB::beginTransaction();
            $account = $transaction->account;
            $account->balance -= $transaction->amount;
            $account->save();
            $transaction->type = $request->input("t-$id-type");
            $transaction->account_id = $request->input("t-$id-account");
            $transaction->category_id = $request->input("t-$id-category");
            $transaction->date = $request->input("t-$id-date");
            $transaction->description = $request->input("t-$id-description") ?? '';
            /** @var Account $account */
            $account = $user->accounts()->where('accounts.id', '=', $transaction->account_id)->first();
            $transaction->amount = abs($request->input("t-$id-amount"));
            $transaction->amount = Rate::convert($transaction->amount, $transaction->currency, $account->currency);
            $transaction->currency = $account->currency;
            $account->balance += $transaction->amount;
            $account->save();
            $transaction->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
        return redirect()->back();
    }

    /**
     * Method return total balance of auth user
     * by grouping accounts by currency, converting to user's main currency and sum all balances
     *
     * @param string $userCurrency - main user's currency
     * @param Collection|Account[]|null $accounts - all user's accounts
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
        return number_format($total, 2, '.', ',');
    }


}


