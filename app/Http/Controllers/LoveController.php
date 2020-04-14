<?php


namespace App\Http\Controllers;


class LoveController extends Controller
{
    public function chikiPiki($name1='charley', $name2='chaplin'){
        return view('love', ['name1'=>$name1, 'name2'=>$name2]);
    }

}
