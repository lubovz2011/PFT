<?php


namespace App\Http\Controllers;


use App\Models\Account;
use App\Models\Category;
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
        /** @var Account[] $accounts */
        $accounts = $user->accounts;
        /** @var Category[] $categories */
        $categories = $user->categories()->whereNull('parent_id')->where('status', 1)
            ->with(['categories' => function($query){
                $query->where('status', 1);
            }])->get();

        $transactions = $user->transactions()
                        ->with('account')->where('status', 1)
                        ->with('category')->where('status', 1)
                        ->get()->groupBy('category_id');

        /**
         * Function used to filter categories that was not used in transactions
         *
         * @param $category
         * @return bool
         */
        $categoryFilter = function ($category) use ($transactions){
            if($transactions->has($category->id))
                return true;
            return (bool)$category->categories->count();
        };

        /**
         * Collect categories that was used in transactions using $categoryFilter function
         */
        $categories = $categories->transform(function ($category) use ($categoryFilter) {
            $category->categories = $category->categories->filter($categoryFilter);
            return $category;
        })->filter($categoryFilter);

        return view('reports', [
            'accounts'     => $accounts,
            'categories'   => $categories,
            'transactions' => $transactions
        ]);
    }
}
