<?php


namespace App\Http\Controllers;


class CategoriesController extends Controller
{
    /**
     * method returns categories page
     * @return \Illuminate\View\View
     */
    public function displayCategoriesPage(){
        return view('categories');
    }
}
