<?php


namespace App\Http\Controllers;


use App\Classes\Category\DefaultCategories;
use App\Models\Account;
use App\Models\Category;
use App\Models\Icon;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

/**
 * Class CategoriesController
 * This class handle user commands on categories
 *
 * @package App\Http\Controllers
 */
class CategoriesController extends Controller
{
    /**
     * Method returns categories page
     * @return \Illuminate\View\View
     */
    public function displayCategoriesPage()
    {
        /** @var User $user */
        $user = auth()->user();
        /** @var Category[] $categories */
        $categories = $user->categories()->whereNull('parent_id')->with('categories')->get()->toArray();

        return view('categories', [
            'categories' => $categories,
            'icons'      => Icon::all()->toArray()
        ]);
    }

    /**
     * Method change category status
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function changeStatus(Request $request)
    {
        $this->validate($request, [
            'categoryId'   => 'bail|integer|required',
            'status' => 'bail|boolean|required'
        ]);
        /** @var User $user */
        $user = auth()->user();
        /** @var Category $category */
        $category = $user->categories()
            ->where('id', '=', $request->input('categoryId'))
            ->with('categories')->first();

        if(isset($category->parent_id)){
            if(!$category->category->status){
                return response()->json($category);
            }
        }
        $category->status = $request->input('status');
        $category->save();

        foreach ($category->categories ?? [] as $subCategory){
            $subCategory->status = $request->input('status');
            $subCategory->save();
        }
        return response()->json($category);
    }

    /**
     * Method delete category
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function deleteCategory(Request $request)
    {
        $this->validate($request, [
            'categoryId'   => 'bail|integer|required'
        ]);

        $status = false; //if category was deleted
        list($category, $groupedTransactions, $accounts) = $this->getDeleteCategoryData($request->input('categoryId'));

        try{
            DB::beginTransaction();
            /** @var Account $account update account */
            foreach ($accounts as $account){
                $account->balance -= $groupedTransactions->get($account->id)->sum('amount');
                $account->save();
            }
            $status = $category->delete();
            if($status)
                DB::commit();
            else
                DB::rollBack();
        }
        catch(\Exception $e) {
            DB::rollBack();
        }

        return response()->json([
            "status" => $status ? "success" : "error"
        ]);
    }

    /**
     * Method get data for delete category
     * @param $categoryId
     * @return array
     */
    private function getDeleteCategoryData($categoryId)
    {
        /** @var User $user */
        $user = auth()->user();
        /** @var Category $category */
        $category = $user->categories()
            ->where('id', '=', $categoryId)
            ->where('lock', '=', 0)->firstOrFail();

        $ids = $category->categories()->get("id")->pluck('id')->toArray();
        $ids[] = $categoryId;

        /** @var Category $category get data for update account */
        $groupedTransactions = $user->transactions()->whereIn('category_id', $ids)->get()->groupBy('account_id');
        $accounts = $user->accounts()->whereIn('id', $groupedTransactions->keys()->toArray())->get();

        return [
          $category, $groupedTransactions, $accounts
        ];
    }

    /**
     * Method create new category
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function addCategory(Request $request)
    {
        $this->validate($request, [
            'name'    => 'bail|string|max:255|required',
            'parent'  => 'bail|nullable|integer|exists:categories,id',
            'icon'    => 'bail|nullable|string|exists:icons,class'
        ]);

        /** @var User $user */
        $user = auth()->user();
        DefaultCategories::generateCategory($user,
                                            $request->input('name'),
                                       $request->input('icon') ?? "",
                                            $request->input('parent'));

        return redirect()->route('categories');
    }
}
