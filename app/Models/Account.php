<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Account
 * This class represent record from accounts table
 *
 * @property integer $id
 * @property string $title
 * @property double $balance
 * @property string $currency
 * @property string $type
 * @property string $credentials
 * @property integer $user_id
 * @property boolean $status
 * @property User $user
 *
 * @package App\Models
 */
class Account extends Model
{
    public $timestamps = false;
    const TYPE_CASH = 'cash';
    const TYPE_CARD = 'card';

    /**
     * Define relation - Account belongs to User
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo("App\Models\User");
    }

    /**
     * Method return account balance converted to user main currency
     * @return float
     */
    public function getBalanceInUserCurrencyAttribute()
    {
        return Rate::convert($this->balance, $this->currency, $this->user->currency);
    }
}
