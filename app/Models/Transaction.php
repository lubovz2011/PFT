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
}
