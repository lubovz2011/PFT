<?php


namespace App\Http\Controllers;


class TransactionsController extends Controller
{
    /**
     * method returns transactions page
     * @return \Illuminate\View\View
     */
    public function displayTransactionsPage()
    {
        $transactionsByDate = $this->getTransactions();
        return view('transactions', ["transactionsByDate" => $transactionsByDate]);
    }

    private function getTransactions(){
        return [
            date("d/m/Y l") => [
                ["id" => 1, "amount" => number_format(-25, 2, '.', ','), "currency" => "ILS", "categoryName" => "Books", "categoryIcon" => "fas fa-user-graduate"],
                ["id" => 2, "amount" => number_format(-75.10, 2, '.', ','), "currency" => "ILS", "categoryName" => "Internet", "categoryIcon" => "fas fa-file-invoice-dollar"],
                ["id" => 3, "amount" => number_format(5, 2, '.', ','), "currency" => "ILS", "categoryName" => "Bonus", "categoryIcon" => "fas fa-hand-holding-usd"]
            ]
        ];
    }
}
