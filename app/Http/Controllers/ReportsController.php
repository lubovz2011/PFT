<?php


namespace App\Http\Controllers;


use App\Classes\Utils\DataSets;
use App\Models\Account;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

/**
 * Class ReportsController
 * This class handle user commands on reports
 *
 * @package App\Http\Controllers
 */
class ReportsController extends Controller
{
    /**
     * Method return reports (dashboard) page
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function displayReportsPage(Request $request)
    {
        list($user, $categories, $accounts, $transactions) = $this->getDataForReport($request);
        $filteredCategories = $this->filterCategoriesForReport($transactions, $categories);
        list($totalPositive, $totalNegative) = $this->getTotalsForReport($filteredCategories, $transactions);

        return view('reports', [
            'accounts'              => $accounts,
            'categories'            => $categories->where('parent_id', '=', null),
            'filteredCategories'    => $filteredCategories,
            'transactions'          => $transactions,
            'mainCurrency'          => $user->currency,
            'totalPositive'         => $totalPositive,
            'totalNegative'         => $totalNegative,
            'links'                 => $this->getPageLinks($request)
        ]);
    }

    /**
     * Method return all required data for dashboard page
     * @param Request $request
     * @return array [$user, $categories, $accounts, $transactions]
     */
    private function getDataForReport(Request $request)
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

        return [$user, $categories, $accounts, $transactions];
    }

    /**
     * Method return only those categories that contain transactions
     * @param $transactions
     * @param $categories
     * @return mixed
     */
    private function filterCategoriesForReport($transactions, $categories)
    {
        //set to $filteredCategories all categories that have transactions
        $categoryIds = $transactions->groupBy('category_id')->keys()->toArray();
        $filteredCategories = $categories->only($categoryIds)->keyBy('id');

        //push missing parent categories to $filteredCategories for subCategories that have transactions
        foreach ($filteredCategories as $category)
        {   //check if category is subCategory
            if(!empty($category->parent_id))
            {   //check if parent not exists in filteredCategories
                if(!$filteredCategories->has($category->parent_id))
                {   //check if parent exists in full category list
                    if($categories->has($category->parent_id))
                    {   //add parent to filteredCategories
                        $parent = $categories->get($category->parent_id);
                        $filteredCategories->put($parent->id, $parent);
                    }
                    else
                        //remove from filteredCategories subCategory that has not parent
                        $filteredCategories->forget($category->id);
                }
            }
        }
        return $filteredCategories;
    }

    /**
     * Method return positive ang negative amounts
     * @param $filteredCategories
     * @param $transactions
     * @return float[]
     */
    private function getTotalsForReport($filteredCategories, $transactions)
    {
        $totalPositive = 0; //total positive amount for category
        $totalNegative = 0; //total negative amount for category

        foreach ($filteredCategories->where('parent_id', '=', null) as $category)
        {
            /** @var Category $category */
            $totalAmount = $category->getAmountForReport($transactions, $filteredCategories);

            if($totalAmount >= 0)
                $totalPositive += $totalAmount;
            else
                $totalNegative += $totalAmount;
        }
        return [$totalPositive, $totalNegative];
    }

    /**
     * Method generate suitable link for dashboard page using chosen filters
     * @param Request $request
     * @return array $links
     */
    private function getPageLinks(Request $request)
    {
        $links = [];
        $params = $request->all();
        unset($params['filter-types']);
        $links['all'] = \route('reports', $params);

        $params['filter-types'] = 'income';
        $links['income'] = \route('reports', $params);

        $params['filter-types'] = 'expense';
        $links['expense'] = \route('reports', $params);
        // pftracker.com/dashboard?filter-time=10

        $timeOptions=DataSets::getDateOptions();
        $timeFilter=$request->input('filter-times');

        /* create links for previous and next months */
        if(empty($timeOptions[$timeFilter])) {
            $nextDate = Carbon::parse($timeFilter)->startOfMonth()->addMonth()->format('FY');
            $prevDate = Carbon::parse($timeFilter)->startOfMonth()->subMonth()->format('FY');
            $params = $request->all();
            $params['filter-times'] = $nextDate;
            $links['next'] = \route('reports', $params);
            $params['filter-times'] = $prevDate;
            $links['prev'] = \route('reports', $params);
        }
        return $links;
    }
}
