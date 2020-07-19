<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * Class Icon
 * @package App\Models
 * @property string $name
 * @property string $class
 */
class Icon extends Model
{
    public $timestamps = false;
    protected $primaryKey = null;
    public $incrementing = false;
}
