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

class TransactionsController extends Controller
{
    /**
     * method return transactions page
     * @return \Illuminate\View\View
     */
    public function displayTransactionsPage(Request $request)
    {
        //dd($request->all());
        /** @var User $user */
        $user = auth()->user();
        /** @var Account[] $accounts */
        $accounts = $user->accounts;
        /** @var Category[] $categories */
        $categories = $user->categories()->whereNull('parent_id')->where('status', 1)
                                         ->with(['categories' => function($query){
                                             $query->where('status', 1);
                                         }])->get();
        $transactions = $user->transactions()
                             ->when(!empty($request->input('filter-times')), function($query) use ($request){
                                    /** @var QueryBuilder $query */
                                    switch ($request->input('filter-times')) {
                                        case 1: $query->where('date', '=', Carbon::now()); break; //today
                                        case 2: $query->where('date', '=', Carbon::now()->subDay()); break; //yesterday
                                        case 3: $query->where('date', '>', Carbon::now()->subDays(7))
                                                      ->where('date', '<=', Carbon::now()); break; //last 7 days
                                        case 4: $query->where('date', '>', Carbon::now()->subDays(30))
                                                      ->where('date', '<=', Carbon::now()); break; // Last 30 days
                                        case 5: $query->where('date', '>=', Carbon::now()->firstOfMonth())
                                                      ->where('date', '<=', Carbon::now()); break; // This Month
                                        case 6: $query->where('date', '>=', Carbon::now()->subMonth()->firstOfMonth())
                                                      ->where('date', '<=', Carbon::now()->subMonth()->lastOfMonth()); break; // Last Month
                                    }
                             })
                             ->when(!empty($request->input('filter-types')), function($query) use ($request){
                                 $query->where('transactions.type', $request->input('filter-types'));
                             })
                             ->when(!empty($request->input('filter-accounts')), function($query) use ($request){
                                 $query->whereIn('account_id', $request->input('filter-accounts'));
                             })
                             ->when(!empty($request->input('filter-categories')), function ($query) use ($request){
                                 $query->whereIn('category_id', $request->input('filter-categories'));
                             })
                             ->with('category')
                             ->with('account')
                             ->orderBy('date', 'desc')
                             ->orderBy('id', 'desc')
                             ->paginate($user->limit);
        if($transactions->currentPage() > $transactions->lastPage())
            return redirect()->route('transactions', ['page' => $transactions->lastPage()]);
//        dd($transactions);

        return view('transactions', [
            'paginator'          => $transactions,
            "totalBalance"       => $this->totalBalance($user->currency, $user->accounts),
            "currency"           => $user->currency,
            "accounts"           => $accounts,
            "categories"         => $categories
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
            'amount'      => 'bail|numeric',
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
            $transaction->amount = abs($request->input("t-$id-amount"));
            $transaction->description = $request->input("t-$id-description") ?? '';
            /** @var Account $account */
            $account = $user->accounts()->where('accounts.id', '=', $transaction->account_id)->first();
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
        $totalByCurrency = 0;
        $total = 0;
        foreach ($groupByCurrency as $currency => $accounts){
            foreach ($accounts as $account)
                /** @var Account $account */
                $totalByCurrency += $account->balance;
            $total += Rate::convert($totalByCurrency, $currency, $userCurrency);
        }
        return number_format($total, 2, '.', ',');
    }


}


