<?php


namespace App\Http\Controllers;


use App\Models\Account;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    /**
     * method returns reports page
     * @return \Illuminate\View\View
     */
    public function displayReportsPage()
    {
        /** @var User $user */
        $user = auth()->user();

        /** @var Account[]|Collection $accounts */
        $accounts = $user->accounts;

        /** @var Category[]|Collection $categories */
        $categories = $user->categories()->where('status', 1)->get()->keyBy('id');

        /** @var Transaction[]|Collection $transactions */
        $transactions = $user->transactions()
                        ->with('account')->where('status', 1)
                        ->with('category')->where('status', 1)
                        ->get()->groupBy('category_id');

        /**
         * Set to $filteredCategories all categories that have transactions
         */
        $filteredCategories = $categories->only($transactions->keys()->toArray())->keyBy('id');

        /**
         * Push missing parent categories to $filteredCategories for subCategories that have transactions
         */
        foreach ($filteredCategories as $category) {
            if(!empty($category->parent_id)){
                if(!$filteredCategories->has($category->parent_id)) {
                    if($categories->has($category->parent_id))
                        $filteredCategories->push($categories->get($category->parent_id));
                    else
                        $filteredCategories->forget($category->id);
                }
            }
        }

//        dd($filteredCategories->toArray(), $transactions->toArray());
        return view('reports', [
            'accounts'     => $accounts,
            'categories'   => $filteredCategories,
            'transactions' => $transactions
        ]);
    }
}
