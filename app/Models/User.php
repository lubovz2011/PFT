<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 *
 * @property integer $id
 * @property string $name
 * @property string $login
 * @property \DateTime|null $status
 * @property string $password
 * @property string $login_type
 * @property string $time_format
 * @property string $date_format
 * @property integer $week_start
 * @property integer $limit
 * @property string $currency
 * @property string[]|null $currencies
 * @property bool $monthly_report
 * @property \DateTime|null $last_activity
 * @property Account[]|Collection $accounts
 * @property Category[]|Collection $categories
 * @property Transaction[]|Collection $transactions
 * @property string $identifier
 * @package App\Models
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['login', 'password', 'name', 'login_type'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'datetime',
    ];

    public function accounts(){
        return $this->hasMany(Account::class);
    }

    public function categories(){
        return $this->hasMany(Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function transactions(){
        return $this->hasManyThrough(Transaction::class, Account::class);
    }
}
