<?php


namespace App\Http\Controllers;


use App\Helpers\Helpers;
use App\Models\Account;
use App\Models\Category;
use App\Models\Rate;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class TransactionsController
 * This class handle user commands on transactions
 *
 * @package App\Http\Controllers
 */
class TransactionsController extends Controller
{
    /**
     * Method return transactions page
     * @return \Illuminate\View\View
     */
    public function displayTransactionsPage(Request $request)
    {
        list($user, $accounts, $categories, $transactions) = $this->getDataForTransactionsPage($request);

        //if requested page number is bigger than last page number, then redirect to last page
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
     * Method create new transaction
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function addTransaction(Request $request)
    {
        $this->addTransactionValidation($request);
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
     * Method validate request data for new transaction
     * @param Request $request
     * @throws \Illuminate\Validation\ValidationException
     */
    private function addTransactionValidation(Request $request)
    {
        $this->validate($request, [
            'type'        => 'required|in:income,expense',
            'account'     => 'bail|required|integer',
            'category'    => 'bail|required|integer|exists:categories,id',
            'date'        => 'bail|required|date',
            'amount'      => 'bail|required|numeric|between:-999999.99,999999.99',
            'description' => 'bail|max:1024'
        ]);
    }

    /**
     * Method delete transaction
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function deleteTransaction(Request $request)
    {
        $this->validate($request, [
            'id' => 'bail|required|integer|exists:transactions,id'
        ]);
        /** @var User $user */
        $user = auth()->user();
        $transaction = $user->transactions()
                            ->where('transactions.id', '=', $request->input('id'))
                            ->first();
        $account = $transaction->account;
        $account->balance -= $transaction->amount;
        $account->save();
        $transaction->delete();
        return redirect()->back();
    }

    /**
     * Method update transaction
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateTransaction(Request $request)
    {
        $id = $this->updateTransactionValidation($request);
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
            $transaction->amount = $request->input("t-$id-amount");
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
     * Method validate request data for transaction updating
     * @param Request $request
     * @return int $id
     * @throws \Illuminate\Validation\ValidationException
     */
    private function updateTransactionValidation(Request $request)
    {
        $this->validate($request, [
            'id' => 'bail|required|integer|exists:transactions,id'
        ]);
        $id = $request->input('id');
        $this->validate($request, [
            "t-$id-type"     => 'bail|required|in:income,expense',
            "t-$id-account"  => 'bail|required|integer',
            "t-$id-category" => 'bail|required|integer|exists:categories,id',
            "t-$id-date"     => 'bail|required|date',
            "t-$id-amount"   => 'bail|required|numeric|between:-999999.99,999999.99',
            "t-$id-description" => 'bail|max:1024'
        ],
        [
            "between" => [
                'numeric' => 'This field must be between :min and :max',
                ]
        ]);
        return $id;
    }

    /**
     * Method return total balance of auth user
     * by grouping accounts by currency, converting to user's main currency and sum all balances
     * @param string $userCurrency - main user's currency
     * @param Collection|Account[]|null $accounts - all user's accounts
     * @return string
     */
    private function totalBalance(string $userCurrency, $accounts = null)
    {
        $accounts = $accounts ?? collect([]);
        $groupByCurrency = $accounts->groupBy('currency');
        $total = 0;
        foreach ($groupByCurrency as $currency => $accounts){
            $total += Rate::convert($accounts->sum('balance'), $currency, $userCurrency);
        }
        return Helpers::NumberFormat($total);
    }

    /**
     * Method return all required data for transactions page
     * @param Request $request
     * @return array [$user, $accounts, $categories, $transactions]
     */
    private function getDataForTransactionsPage(Request $request)
    {
        /** @var User $user */
        $user = auth()->user();
        /** @var Account[] $accounts */
        $accounts = $user->accounts;
        /** @var Category[] $categories */
        $categories = $user->categories()->whereNull('parent_id')
                                         ->with('categories')->get();
        $transactions = $user->transactions();
        $this->attachFilterTimesToQuery($transactions, $request);
        $transactions = $this->attachFiltersToQuery($transactions, $request)
                             ->with('category')
                             ->orderBy('date', 'desc')
                             ->orderBy('id', 'desc')
                             ->paginate($user->limit);
        $transactions->appends($request->all()); //for adding request parameters to url (filters)

        return [$user, $accounts, $categories, $transactions];
    }
}


