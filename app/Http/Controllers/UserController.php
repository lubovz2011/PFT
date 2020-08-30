<?php


namespace App\Http\Controllers;


use App\Classes\Requests\SaltEdge\Customer\DeleteCustomer;
use App\Models\User;
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
            "login"         => $user->login,
            "name"          => $user->name,
            "userName"      => $user->name ?: $user->login,
            "dateFormat"    => $user->date_format,
            "timeFormat"    => $user->time_format,
            "weekStart"     => $user->week_start,
            "limit"         => $user->limit,
            "mainCurrency"  => $user->currency,
            "currencies"    => explode(',', $user->currencies ?: ""),
            "monthlyReport" => (bool)$user->monthly_report
        ];
        return view('settings.settings', $params);
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
            'name'  => 'string|max:255',
            'login' => 'bail|required|email|max:255'.$additionalLoginValidation
        ]);

        $user->name = $request->input("name");
        $user->login = $request->input("login");
        $user->save();

        return redirect()->route("settings");
    }

    public function editInterface(Request $request){
        $user = auth()->user();
        $this->validate($request, [
            'date_format'   => 'bail|required|in:Y/m/d,m/d/Y,d/m/Y,d.m.Y,d-m-Y',
            'time_format'    => 'bail|required|in:H:i,h:i A',
            'week_start'    => 'bail|required|in:0,1,2,3,4,5,6',
            'limit'         => 'bail|required|in:10,20,25,50,100',
            'main_currency' => 'bail|required|in:ILS,USD,EUR,GBP,JPY',
            'currencies.*'    => 'bail|required|in:ILS,USD,EUR,GBP,JPY'
        ]);
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
        $this->validate($request, [
            'password'  => 'bail|required|min:8|string|confirmed'
        ]);
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

    public function deleteProfile(){
        /** @var User $user */
        $user = auth()->user();
        auth()->logout();
//        (new DeleteCustomer())->setIdentifier($user->identifier)->send();
        $user->delete();
        return redirect()->route('welcome');
    }
}
