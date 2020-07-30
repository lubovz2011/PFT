<?php


namespace App\Http\Controllers;


use App\Models\Account;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    /**
     * method returns transactions page
     * @return \Illuminate\View\View
     */
    public function displayTransactionsPage()
    {
        /** @var User $user */
        $user = auth()->user();

        /** @var Account[] $accounts */
        $accounts = $user->accounts;

        /** @var Category[] $categories */
        $categories = $user->categories()->whereNull('parent_id')->with('categories')->get();

        $transactionsByDate = $this->getTransactions();
        return view('transactions', [
            "transactionsByDate" => $transactionsByDate,
            "accounts" => $accounts,
            "categories" => $categories
        ]);
    }

    private function getTransactions(){
        return [
            date("d/m/Y l") => [
                ["id" => 1, "amount" => number_format(-25, 2, '.', ','), "currency" => "ILS", "categoryName" => "Books", "categoryIcon" => "fas fa-user-graduate"],
                ["id" => 2, "amount" => number_format(-75.10, 2, '.', ','), "currency" => "ILS", "categoryName" => "Internet", "categoryIcon" => "fas fa-file-invoice-dollar"],
                ["id" => 3, "amount" => number_format(5, 2, '.', ','), "currency" => "ILS", "categoryName" => "Bonus", "categoryIcon" => "fas fa-hand-holding-usd"]
            ]
        ];
    }

    public function addTransaction(Request $request)
    {
        $this->validate($request, [
            'type'      => 'required|in:income,expense',
            'account'     => 'bail|required|integer',
            'category'    => 'bail|required|integer|exists:categories,id',
            'date'        => 'bail|required|date',
            'amount'      => 'bail|numeric|min:0',
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
        $transaction->amount = $request->input('amount');
        $transaction->currency = $account->currency;
        $transaction->date = $request->input('date');
        $transaction->description = $request->input('description') ?? '';
        $transaction->save();
        $account->balance += ($transaction->type == 'income' ? 1 : -1) * $transaction->amount;
        $account->save();
        return redirect()->route('transactions');
    }
}
