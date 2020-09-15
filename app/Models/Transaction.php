<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Transaction
 * This class represent record from transactions table
 *
 * @property integer $id
 * @property string $description
 * @property string $currency
 * @property double $amount
 * @property string $type
 * @property string $date
 * @property integer $account_id
 * @property integer $category_id
 * @property Account $account
 * @property Category $category
 *
 * @package App\Models
 */
class Transaction extends Model
{
    public $timestamps = false;

    /**
     * Define relation - Transaction belongs to Category
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Define relation - Transaction belongs to Account
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    /**
     * Method return transaction date in date format from user settings
     * @param $date
     * @return false|string
     */
    public function getDateAttribute($date)
    {
        return date(auth()->user()->date_format . " l", strtotime($date));
    }

    /**
     * Method return natural value of amount depending on the type of transaction
     * @param $amount
     * @return float|int
     */
    public function getAmountAttribute($amount)
    {
        $mult = 1;
        if($this->type == 'expense')
            $mult = -1;
        return $mult * $amount;
    }

    /**
     * Method return transaction amount converted to user main currency
     * @return float
     */
    public function getAmountInUserCurrencyAttribute()
    {
        return Rate::convert($this->amount, $this->currency, $this->account->user->currency);
    }

    /**
     * Method return transaction date in format compatible for <input type=date>
     * @return false|string
     */
    public function getDateForInput()
    {
        return date("Y-m-d", strtotime($this->attributes['date']));
    }
}
