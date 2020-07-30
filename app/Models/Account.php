<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Account
 *
 * @property integer $id
 * @property string $title
 * @property double $balance
 * @property string $currency
 * @property string $type
 * @property string $credentials
 * @property integer $user_id
 * @property Account[] $accounts
 *
 * @package App\Models
 */
class Account extends Model
{
    const TYPE_CASH = 'cash';
    const TYPE_CARD = 'card';

    public function user(){
        return $this->belongsTo("App\Models\User");
    }
}
