<?php


namespace App\Http\Controllers;


use App\Classes\Utils\DataSets;
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
        $accounts = $user->accounts()->where('status', 1)->get()->keyBy('id');

        /** @var Category[]|Collection $categories */
        $categories = $user->categories()->where('status', 1)->get()->keyBy('id');


        $transactions = $user->transactions();
        $this->attachFilterTimesToQuery($transactions, $request, true);

        /**
         * set to $transactions all user transactions where account and category of each transaction are enabled
         * @var Transaction[]|Collection $transactions
         */
        $transactions = $this->attachFiltersToQuery($transactions, $request)
                        ->whereIn('account_id', $accounts->keys()->toArray())
                        ->whereIn('category_id', $categories->keys()->toArray())
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

        $timeOptions=DataSets::getDateOptions();

        $timeFilter=$request->input('filter-times');

        if(empty($timeOptions[$timeFilter])) {
            $nextDate = Carbon::parse($timeFilter)->startOfMonth()->addMonth()->format('FY');
            $prevDate = Carbon::parse($timeFilter)->startOfMonth()->subMonth()->format('FY');
            $params = $request->all();
            $params['filter-times'] = $nextDate;
            $links['next'] = \route('reports', $params);
            $params['filter-times'] = $prevDate;
            $links['prev'] = \route('reports', $params);
        }

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
