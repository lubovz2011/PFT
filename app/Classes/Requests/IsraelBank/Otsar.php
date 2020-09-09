<?php


namespace App\Classes\Requests\IsraelBank;


use App\Classes\Requests\AbstractRequest;
use App\Models\Account;
use App\Models\Transaction;
use Carbon\Carbon;

/**
 * Class Otsar
 * This class handle connection to Otsar Hahayal Bank
 *
 * @package App\Classes\Requests\IsraelBank
 */
class Otsar extends AbstractRequest
{
    /** @var Account $account */
    private $account;

    /**
     * account Setter
     * @param Account $account
     * @return $this
     */
    public function setAccount(Account $account)
    {
        $this->account = $account;
        return $this;
    }

    /**
     * Method return url of api we are going to call
     * @return string
     */
    function getUrl(): string
    {
        return env('ISRAEL_BANKS_URL').'/otsar';
    }

    /**
     * Method return request headers
     * @return string[]
     */
    function getHeaders(): array
    {
        return [
            'Accept'        => 'application/json',
            'Content-Type'  => 'application/json'
        ];
    }

    /**
     * Method return request body
     * body - data that will be sent to api
     * @return false|string
     */
    function getBody()
    {
        $data = json_decode($this->account->credentials);

        return json_encode([
            'username'   => decrypt($data->username),
            'password'   => decrypt($data->password),
            'lastUpdate' => $data->lastUpdate ?? Carbon::now()->startOfMonth()->subMonth()->toIso8601String()
        ]);
    }

    /**
     * Method return request method
     * @return string
     */
    function getMethod(): string
    {
        return self::METHOD_POST;
    }

    /**
     * Method handle response data
     * @param string $data
     */
    function parseResponse(string $data)
    {
        //data from response
        $data = json_decode($data);
        $accountName = $data[0]->accountNumber;
        $balance  = $data[0]->summary->balance;
        $currency = $data[0]->summary->balanceCurrency;
        $txns = $data[0]->txns ?? [];

        $credentials = json_decode($this->account->credentials);
        $this->handleTransactions($txns, $credentials, $currency);

        //update account data
        $this->account->credentials = json_encode($credentials);
        $this->account->title = "Otsar Hahayal " . $accountName;
        $this->account->balance = $balance;
        $this->account->currency = $currency;
        $this->account->save();
    }

    /**
     * Method handle response transactions
     * @param array $txns
     * @param \stdClass $credentials
     * @param string $currency
     * @param int $lockedCategory
     */
    private function handleTransactions(array $txns, \stdClass $credentials, string $currency)
    {
        $lockedCategory = $this->account->user->categories()->where('lock', '=', true)->first()->id;
        foreach ($txns as $txn){
            $txnDate = Carbon::parse($txn->date);
            if($txnDate->toIso8601String() != ($credentials->lastUpdate ?? '')){
                $transaction = new Transaction();
                $transaction->amount = abs($txn->chargedAmount);
                $transaction->currency = $currency;
                $transaction->type = $txn->chargedAmount >= 0 ? 'income' : 'expense';
                $transaction->description = $txn->description;
                $transaction->date = $txnDate;
                $transaction->account_id = $this->account->id;
                $transaction->category_id = $lockedCategory;
                $transaction->save();
            }
        }
        $credentials->lastUpdate = Carbon::parse($txn->date)->toIso8601String();
    }
}
