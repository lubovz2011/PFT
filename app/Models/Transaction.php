<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 *
 * Class Transaction
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
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function account(){
        return $this->belongsTo(Account::class);
    }

    public function getDateAttribute($date){
        return date(auth()->user()->date_format . " l", strtotime($date));
    }

    public function getAmountAttribute($amount){
        $mult = 1;
        if($this->type == 'expense')
            $mult = -1;
        return number_format($mult * $amount, 2, '.', ',');
    }

    public function getDateForInput(){
        return date("Y-m-d", strtotime($this->date));
    }
}
