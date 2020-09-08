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

    /**
     * method returns about-us page
     * @return \Illuminate\View\View
     */
    public function displayAboutUsPage(){
        return view('about-us');
    }
}
