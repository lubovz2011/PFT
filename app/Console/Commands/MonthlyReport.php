<?php


namespace App\Console\Commands;


use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

/**
 * Class MonthlyReport
 * This class handle the monthly report for all users that accept this action
 *
 * @package App\Console\Commands
 */
class MonthlyReport extends Command
{
    /**
     * script name for artisan command
     * @example php artisan monthly_report
     * @var string
     */
    protected $signature = 'monthly_report';

    /**
     * This method execute the console command
     */
    public function handle()
    {
        //get all user ids that accept to get monthly report email
        $userIds = DB::table('users')->select('id')->where('monthly_report', '=', '1')->get();

        foreach ($userIds as $userId)
        {
            /** @var User $user */
            $user = User::find($userId->id); //get user from DB by id
            $this->info("sending email to : ".$user->login); //console message
            $mail = new \App\Mail\MonthlyReport($user); //create Email object
            Mail::to($user->login)->send($mail); //send email to user
        }
    }
}
