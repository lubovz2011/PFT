<?php


namespace App\Console\Commands;


use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

/**
 * Class PasswordNotifications
 * This class handle the password notifications
 *
 * @package App\Console\Commands
 */
class PasswordNotifications extends Command
{
    protected $signature = 'password_notification';

    /**
     * Method send every 3 months password notification mail to user
     */
    public function handle()
    {
        //get all user ids that register with email
        $userIds = User::select('id')->where('login_type', '=', 'email')->get();

        foreach ($userIds as $userId)
        {
            /** @var User $user */
            $user = User::find($userId->id); //get user from DB by id
            $diff = $this->getDiff($user);
            if($diff % 3 == 0){
                $this->info("sending email to : ".$user->login); //console message
                $message = "We're here to remind you it's time to reset your password.\n".
                           "You do not have to but are highly recommended to secure your user account.\n\n".
                           "Regards, PFT";

                Mail::raw($message, function ($mail) use ($user)
                {
                    $mail->subject("Password Notification");
                    $mail->to($user->login);
                });
            }
        }
    }

    /**
     * Method calculate the difference between registration date of user and current date
     * @param $user
     * @return float
     */
    private function getDiff($user)
    {
        /** @var Carbon $date */
        $date = $user->created_at;
        $date = $date->startOfDay();
        $now = Carbon::now()->startOfDay();

        return $date->floatDiffInMonths($now);
    }
}
