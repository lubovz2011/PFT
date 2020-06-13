<?php


namespace App\Classes;


use App\Models\User;

abstract class Defaults
{
    public abstract static function generate(User $user);
}
