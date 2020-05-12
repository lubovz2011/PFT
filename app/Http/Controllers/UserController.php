<?php


namespace App\Http\Controllers;


class UserController extends Controller
{
    /**
     * method returns settings page
     * @return \Illuminate\View\View
     */
    public function displaySettingsPage(){
        return view('settings');
    }
}
