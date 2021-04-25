<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * This class represent record from users table
 *
 * @property integer $id
 * @property string $name
 * @property string $login
 * @property \DateTime|null $email_verified_at
 * @property string $password
 * @property string $login_type
 * @property string $date_format
 * @property integer $limit
 * @property string $currency
 * @property string|null $currencies
 * @property bool $monthly_report
 * @property Account[]|Collection $accounts
 * @property Category[]|Collection $categories
 * @property Transaction[]|Collection $transactions
 * @package App\Models
 */
class User extends Authenticatable /*implements MustVerifyEmail*/
{
   /* use Notifiable;*/

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['login', 'password', 'name', 'login_type', 'email_verified_at'];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Define relation - User has many Accounts
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function accounts(){
        return $this->hasMany(Account::class);
    }

    /**
     * Define relation - User has many Categories
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categories(){
        return $this->hasMany(Category::class);
    }

    /**
     * Define relation - User has many Transactions through Account
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function transactions(){
        return $this->hasManyThrough(Transaction::class, Account::class);
    }

    /**
     * Method return user login (email)
     * @return string
     */
    protected function getEmailAttribute(){
        return $this->login;
    }
}
