<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 *
 * @property integer $id
 * @property string $name
 * @property integer $parent_id
 * @property boolean $status
 * @property string $icon
 * @property integer $user_id
 *
 * @package App\Models
 */
class Category extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }
}
