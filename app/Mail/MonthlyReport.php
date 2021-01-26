<?php

namespace App\Mail;


use App\Models\Account;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

/**
 * Class MonthlyReport
 * This class built pretty email
 *
 * @package App\Mail
 */
class MonthlyReport extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Method build the message.
     * @return MonthlyReport
     */
    public function build()
    {
        list($accounts, $categories, $startOfMonth, $transactions) = $this->getDataForReport();

        //calculate all values for the report
        /** @var Transaction $transaction */
        $totalIncome = $transactions->where('type', '=', 'income')->sum('amountInUserCurrency');
        $totalExpense = $transactions->where('type', '=', 'expense')->sum('amountInUserCurrency');
        $endBalance = $accounts->sum('balanceInUserCurrency');
        $startBalance = $endBalance - $totalIncome - $totalExpense;
        $profit = $totalIncome + $totalExpense;
        $avgPerMonth = $this->avgPerMonth($accounts, $categories);

        return $this->view('mail.monthly-report', [
            "start_balance" => $startBalance,
            "end_balance"   => $endBalance,
            "income"        => $totalIncome,
            "expense"       => $totalExpense,
            "total_balance" => $profit,
            "currency"      => $this->user->currency,
            "transactions"  => $transactions->count(),
            "month"         => $startOfMonth->format("M Y"),
            "avg_per_month" => $this->prognosis($avgPerMonth)
        ]);
    }

    /**
     * Method return the avg monthly balance change for the last 3 months
     * @param $accounts
     * @param $categories
     * @return float|int
     */
    public function avgPerMonth($accounts, $categories)
    {
        $thirdMonth = Carbon::now()->firstOfMonth()->subMonth();
        $secondMonth = (clone $thirdMonth)->subMonth();
        $firstMonth = (clone $secondMonth)->subMonth();
        $months = [$firstMonth, $secondMonth, $thirdMonth];
        $total = 0;

        foreach ($months as $month)
        {
            /** @var Transaction[]|Collection $transactions */
            $transactions = $this->user->transactions()->whereIn('account_id', $accounts->pluck('id')->all())
                ->whereIn('category_id', $categories->pluck('id')->all())
                ->whereDate('date', '>=', $month)
                ->whereDate('date', '<=', (clone $month)->endOfMonth())
                ->get();

            if(!$transactions->count())
                return 0;
            else
                $total += $transactions->sum('amountInUserCurrency');
        }
        return $total / 3;
    }

    /**
     * Method calculate prognosis for the next 3-36 months
     * @param float $avgPerMonth
     * @return array|float[]|int[]
     */
    private function prognosis(float $avgPerMonth){
        if(empty($avgPerMonth))
            return [];
        return [
            "3 Months"  => $avgPerMonth * 3,
            "6 Months"  => $avgPerMonth * 6,
            "1 Year"    => $avgPerMonth * 12,
            "2 Years"   => $avgPerMonth * 24,
            "3 Years"   => $avgPerMonth * 36
        ];
    }

    /**
     * Method return all required data for monthly report
     * @return array
     */
    private function getDataForReport()
    {
        /** @var Account[]|Collection $accounts */
        $accounts = $this->user->accounts()->where('status', '=', 1)->get();

        /** @var Category[]|Collection $categories */
        $categories = $this->user->categories()->where('status', '=', 1)->get();

        $startOfMonth = Carbon::now()->firstOfMonth()->subMonth();
        $endOfMonth = (clone $startOfMonth)->lastOfMonth();

        /** @var Transaction[]|Collection $transactions */
        $transactions = $this->user->transactions()->whereIn('account_id', $accounts->pluck('id')->all())
            ->whereIn('category_id', $categories->pluck('id')->all())
            ->whereDate('date', '>=', $startOfMonth)
            ->whereDate('date', '<=', $endOfMonth)
            ->get();

        return [$accounts, $categories, $startOfMonth, $transactions];
    }
}
