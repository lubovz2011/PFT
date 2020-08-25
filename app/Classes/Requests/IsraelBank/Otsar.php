<?php


namespace App\Classes\Requests\IsraelBank;


use App\Classes\Requests\AbstractRequest;
use App\Models\Account;
use App\Models\Transaction;
use Carbon\Carbon;

class Otsar extends AbstractRequest
{
    /** @var Account $account */
    private $account;

    /**
     * @param Account $account
     * @return $this
     */
    public function setAccount(Account $account)
    {
        $this->account = $account;
        return $this;
    }


    function getUrl(): string
    {
        return env('ISRAEL_BANKS_URL').'/otsar';
    }

    function getHeaders(): array
    {
        return [
            'Accept'        => 'application/json',
            'Content-Type'  => 'application/json'
        ];
    }

    function getBody()
    {
        $data = json_decode($this->account->credentials);

        return json_encode([
            'username'   => $data->username,
            'password'   => $data->password,
            'lastUpdate' => $data->lastUpdate ?? Carbon::now()->startOfMonth()->subMonth()->toIso8601String()
        ]);
    }

    function getMethod(): string
    {
        return self::METHOD_POST;
    }

    function parseResponse(string $data)
    {
        $data = json_decode($data);
        $accountName = $data[0]->accountNumber;
        $balance  = $data[0]->summary->balance;
        $currency = $data[0]->summary->balanceCurrency;
        $txns = $data[0]->txns ?? [];


        foreach ($txns as $txn){
            $transaction = new Transaction();
            $transaction->amount = abs($txn->chargedAmount);
            $transaction->currency = $currency;
            $transaction->type = $txn->chargedAmount >= 0 ? 'income' : 'expense';
            $transaction->description = $txn->description;
            $transaction->date = Carbon::parse($txn->date);
            $transaction->account_id = $this->account->id;
            $transaction->category_id = $this->account->user->categories()->first()->id;
            $transaction->save();
        }
        $credentials = json_decode($this->account->credentials);
        $credentials->lastUpdate = Carbon::parse($txn->date)->toIso8601String();
        $this->account->credentials = json_encode($credentials);
        $this->account->title = "Otsar Hahayal " . $accountName;
        $this->account->balance = $balance;
        $this->account->currency = $currency;
        $this->account->save();
    }
}
