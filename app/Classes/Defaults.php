<?php


namespace App\Classes;


use App\Models\User;

/**
 * Class Defaults
 * Abstract class for defaults
 *
 * @package App\Classes
 */
abstract class Defaults
{
    /**
     * All child classes need to implement this method
     * @param User $user
     * @return mixed
     */
    public abstract static function generate(User $user);
}
