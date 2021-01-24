<?php


namespace App\Http\Controllers;


use App\Classes\Category\DefaultCategories;
use App\Models\Account;
use App\Models\Category;
use App\Models\Icon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        /** @var User $user */
        $user = auth()->user();

        $category = $user->categories()
            ->where('id', '=', $request->input('categoryId'))
            ->where('lock', '=', 0)->firstOrFail();

        /** @var Category $category get data for update account */
        $groups = $category->transactions->groupBy('account_id');
        $accounts = $user->accounts()->whereIn('id', $groups->keys()->toArray())->get();

        /** @var Account $account update account */
        foreach ($accounts as $account){
            $account->balance -= $groups->get($account->id)->sum('amount');
            $account->save();
        }
        return response()->json([
            "status" => $category->delete() ? "success" : "error"
        ]);
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
