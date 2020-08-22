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

        /**
         * set to $transactions all user transactions where account and category of each transaction are enabled
         * @var Transaction[]|Collection $transactions
         */
        $transactions = $user->transactions()
                        ->with('account')->where('status', 1)
                        ->with('category')->where('status', 1)
                        ->get();

        /**
         * Set to $filteredCategories all categories that have transactions
         */
        $categoryIds = $transactions->groupBy('category_id')->keys()->toArray();
        $filteredCategories = $categories->only($categoryIds)->keyBy('id');

        /**
         * Push missing parent categories to $filteredCategories for subCategories that have transactions
         */
        foreach ($filteredCategories as $category)
        {
            if(!empty($category->parent_id)) //check if category is subCategory
            {
                if(!$filteredCategories->has($category->parent_id)) //check if parent not exists in filteredCategories
                {
                    if($categories->has($category->parent_id)) //check if parent exists in full category list
                    {
                        $parent = $categories->get($category->parent_id);
                        $filteredCategories->put($parent->id, $parent); //add parent to filteredCategories
                    }
                    else
                        $filteredCategories->forget($category->id); //remove from filteredCategories subCategory that has not parent
                }
            }
        }

        $totalIncome = 0; //total positive amount for category
        $totalExpense = 0; //total negative amount for category

        foreach ($filteredCategories->where('parent_id', '=', null) as $category)
        {
            $totalAmount = $category->getAmountForReport($transactions, $filteredCategories);

            if($totalAmount >= 0)
                $totalIncome += $totalAmount;
            else
                $totalExpense += $totalAmount;
        }

        return view('reports', [
            'accounts'     => $accounts,
            'categories'   => $filteredCategories,
            'transactions' => $transactions,
            'mainCurrency' => $user->currency,
            'totalIncome'  => $totalIncome,
            'totalExpense' => $totalExpense
        ]);
    }
}
