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


}
