<?php


namespace App\Http\Controllers;

/**
 * Class PagesController
 * This class returns simple pages
 *
 * @package App\Http\Controllers
 */
class PagesController extends Controller
{
    /**
     * Method returns welcome page
     * @return \Illuminate\View\View
     */
    public function displayWelcomePage(){
        return view('index');
    }

    /**
     * Method returns about-us page
     * @return \Illuminate\View\View
     */
    public function displayAboutUsPage(){
        return view('about-us');
    }
}
