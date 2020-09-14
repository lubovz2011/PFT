<?php


namespace App\Http\Controllers;


use App\Classes\Category\DefaultCategories;
use App\Models\Category;
use App\Models\Icon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    /**
     * method returns categories page
     * @return \Illuminate\View\View
     */
    public function displayCategoriesPage()
    {
        /** @var User $user */
        $user = auth()->user();
//        DB::enableQueryLog();
        /** @var Category[] $categories */
        $categories = $user->categories()->whereNull('parent_id')->with('categories')->get()->toArray();
//        dd(DB::getQueryLog(), $categories);
        return view('categories', [
            'categories' => $categories,
            'icons'      => Icon::all()->toArray()
        ]);
    }

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


        return response()->json([
            "status" => $category->delete() ? "success" : "error"
        ]);
    }

    public function addCategory(Request $request)
    {
        $this->validate($request, [
            'name'    => 'bail|string|max:255|required',
            'parent'  => 'bail|nullable|integer|exists:categories,id',
            'icon'    => 'bail|nullable|string|exists:icons,class'
        ]);

        //dd($request->all());
        /** @var User $user */
        $user = auth()->user();

        DefaultCategories::generateCategory($user, $request->input('name'), $request->input('icon') ?? "", $request->input('parent'));

        return redirect()->route('categories');
    }
}
