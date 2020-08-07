<?php


namespace App\Http\Controllers;


use App\Models\Account;
use App\Models\Category;
use App\Models\Rate;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionsController extends Controller
{
    /**
     * method returns transactions page
     * @return \Illuminate\View\View
     */
    public function displayTransactionsPage($page = 1)
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
        $transactions = $user->transactions()
                             ->with('category')
                             ->with('account')
                             ->orderBy('date', 'desc')
                             ->orderBy('id', 'desc')
                             ->limit($user->limit)
                             ->offset($user->limit * ($page - 1))
                             ->get();
        $transactions = $transactions->groupBy('date');

        return view('transactions', [
            "totalBalance"       => $this->totalBalance($user->currency, $user->transactions),
            "currency"           => $user->currency,
            "transactionsByDate" => $transactions,
            "accounts"           => $accounts,
            "categories"         => $categories
        ]);
    }

    public function addTransaction(Request $request)
    {
        $this->validate($request, [
            'type'      => 'required|in:income,expense',
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

    public function totalBalance(string $userCurrency, $transactions = null)
    {
        $groupByCurrency = $transactions->groupBy('currency');
        $totalByCurrency = 0;
        $total = 0;
        foreach ($groupByCurrency as $currency => $transactions){
            foreach ($transactions as $transaction)
                $totalByCurrency += $transaction->amount;
            $total += Rate::convert($totalByCurrency, $currency, $userCurrency);
        }
       // dd($totalByCurrency);
        return number_format($total, 2, '.', ',');
    }
}


