<?php


namespace App\Http\Controllers;


use App\Models\Category;
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
        return view('categories', ['categories' => $categories]);
    }

    public function createCategory(Request $request)
    {
        $this->validate($request, [
            'name'   => 'bail|string|max:255',
            'parent' => ''
        ]);
    }

    public function changeStatus(Request $request)
    {
        $time = microtime(true);
        $this->validate($request, [
            'categoryId'   => 'bail|integer|required',
            'status' => 'bail|boolean|required'
        ]);
        $time1 = microtime(true);
        /** @var User $user */
        $user = auth()->user();
        $time2 = microtime(true);
        /** @var Category $category */
        $category = $user->categories()
            ->where('id', '=', $request->input('categoryId'))
            ->with('categories')->first();
        $time3 = microtime(true);
        $category->status = $request->input('status');
        $category->save();
        $time4 = microtime(true);
        foreach ($category->categories ?? [] as $subCategory){
            $subCategory->status = $request->input('status');
            $subCategory->save();
        }
        $time5 = microtime(true);
//        dd($time1-$time, $time2-$time1, $time3-$time2, $time4-$time3, $time5-$time4, $time5-$time);
        return response()->json($category);
    }

}
