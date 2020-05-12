<?php


namespace App\Http\Controllers;


class PagesController extends Controller
{
    /**
     * method returns welcome page
     * @return \Illuminate\View\View
     */
    public function displayWelcomePage(){
        return view('index');
    }
}
