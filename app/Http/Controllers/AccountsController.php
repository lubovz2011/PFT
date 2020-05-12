<?php


namespace App\Http\Controllers;


class AccountsController extends Controller
{
    /**
     * method returns accounts page
     * @return \Illuminate\View\View
     */
    public function displayAccountsPage(){
        return view('accounts');
    }
}
