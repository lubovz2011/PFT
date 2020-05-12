<?php


namespace App\Http\Controllers;


class ReportsController extends Controller
{
    /**
     * method returns reports page
     * @return \Illuminate\View\View
     */
    public function displayReportsPage(){
        return view('reports');
    }
}
