<?php


namespace App\Console\Commands;


use App\Models\Account;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class MonthlyReport extends Command
{
    protected $signature = 'monthly_report';

    public function handle()
    {
        $userIds = DB::table('users')->select('id')->where('monthly_report', '=', '1')->get();

        foreach ($userIds as $userId)
        {
            /** @var User $user */
            $user = User::find($userId->id);
            $this->info("sending email to : ".$user->login);
            $mail = new \App\Mail\MonthlyReport($user);
            Mail::to($user->login)->send($mail);


        }
    }

}
