<?php

namespace App\Mail;

use App\Helpers\Helpers;
use App\Models\Account;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;

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
     * Build the message.
     *
     * @return $this
     */
    public function build()
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
            ->where('date', '>=', $startOfMonth)
            ->where('date', '<=', $endOfMonth)
            ->get();


        $totalIncome = $transactions->where('type', '=', 'income')->sum('amountInUserCurrency');
        $totalExpense = $transactions->where('type', '=', 'expense')->sum('amountInUserCurrency');
        $endBalance = $accounts->sum('balanceInUserCurrency');
        $startBalance = $endBalance - $totalIncome + $totalExpense;
        $profit = $totalIncome + $totalExpense;

        $avgPerMonth = $this->prognosis($accounts, $categories);

        return $this->view('mail.monthly-report', [
            "start_balance" => $startBalance,
            "end_balance"   => $endBalance,
            "income"        => $totalIncome,
            "expense"       => $totalExpense,
            "total_balance" => $profit,
            "currency"      => $this->user->currency,
            "transactions"  => $transactions->count(),
            "month"         => $startOfMonth->format("M Y"),
            "avg_per_month" => $this->avgPerMonth($avgPerMonth)
        ]);
    }

    public function prognosis($accounts, $categories)
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
                ->where('date', '>=', $month)
                ->where('date', '<=', (clone $month)->endOfMonth())
                ->get();

            if(!$transactions->count())
                return 0;
            else
                $total += $transactions->sum('amount');
        }
        return $total / 3;
    }

    private function avgPerMonth(float $avgPerMonth){
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
}
