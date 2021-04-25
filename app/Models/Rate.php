<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * Class Rate
 * This class represent record from rates table
 *
 * @package App\Models
 *
 * @property integer $id
 * @property string $from
 * @property string $to
 * @property double $rate
 */
class Rate extends Model
{
    public $timestamps = false;

    /**
     * Method return converted amount value
     * @param float $amount
     * @param string $from
     * @param string $to
     * @return float
     */
    public static function convert(float $amount, string $from, string $to)
    {
        if($from == $to)
            return $amount;
        $rate = Rate::where('from', '=', $from)->where('to', '=', $to)->value('rate');
        $amount *= $rate;
        return $amount;
    }
}
