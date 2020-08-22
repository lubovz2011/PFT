<?php


namespace App\Http\Controllers;


use App\Models\Account;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Doctrine\DBAL\Query\QueryBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class ReportsController extends Controller
{
    /**
     * method returns reports page
     * @return \Illuminate\View\View
     */
    public function displayReportsPage(Request $request)
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

        $links = [];
        $params = $request->all();
        unset($params['filter-types']);
        $links['all'] = \route('reports', $params);

        $params['filter-types'] = 'income';
        $links['income'] = \route('reports', $params);

        $params['filter-types'] = 'expense';
        $links['expense'] = \route('reports', $params);

        return view('reports', [
            'accounts'              => $accounts,
            'categories'            => $categories->where('parent_id', '=', null),
            'filteredCategories'    => $filteredCategories,
            'transactions'          => $transactions,
            'mainCurrency'          => $user->currency,
            'totalIncome'           => $totalIncome,
            'totalExpense'          => $totalExpense,
            'links'                 => $links
        ]);
    }
}
