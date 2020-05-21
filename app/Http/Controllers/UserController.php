<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * method returns settings page
     * @return \Illuminate\View\View
     */
    public function displaySettingsPage(Request $request){
        $user = auth()->user();
        $params = [
            "login" => $user->login,
            "name" => $user->name,
            "userName" => $user->name ?: $user->login,
            "dateFormat" => $user->date_format,
            "timeFormat" => $user->time_format,
            "weekStart" => $user->week_start,
            "limit" => $user->limit,
            "mainCurrency" => $user->currency,
            "currencies" => explode(',', $user->currencies ?: ""),
            "monthlyReport" => (bool)$user->monthly_report
        ];
        dump([
            "params" => $params,
            "session" => $request->session()->all()
        ]);
        return view('settings', $params);
    }

    public function editPersonalInfo(Request $request)
    {
        $user = auth()->user();
        $additionalLoginValidation = '';
        if($user->login != $request->input('login'))
        {
            $additionalLoginValidation = '|unique:users,login';
        }
        $this->validate($request, [
            'name' => 'max:255',
            'login' => 'bail|required|email|max:255'.$additionalLoginValidation
        ]);

        $user->name = $request->input("name");
        $user->login = $request->input("login");
        $user->save();

        return redirect()->route("settings");
    }

    public function editInterface(Request $request){
        $user = auth()->user();

        $user->date_format = $request->input("date_format");
        $user->time_format = $request->input("time_format");
        $user->week_start = $request->input("week_start");
        $user->limit = $request->input("limit");
        $user->currency = $request->input("main_currency");
        $user->currencies = implode(",", $request->input("currencies") ?: []);

        $user->save();
        return redirect()->route("settings");
    }

    public function editSecurity(Request $request){
        $user = auth()->user();

        $user->password = Hash::make($request->input("password"));

        $user->save();
        return redirect()->route("settings");
    }

    public function editEmailNotifications(Request $request){
        $user = auth()->user();

        $user->monthly_report = $request->input("monthly_report") == "on";

        $user->save();
        return redirect()->route("settings");
    }
}
