<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
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
 * @property Category[] $categories
 * @property Category $category
 *
 * @package App\Models
 */
class Category extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function categories(){
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function category(){
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function transactions(){
        return $this->hasMany(Transaction::Class);
    }

    public function getIconAttribute($icon){
        if(!empty($this->parent_id))
            return $this->category->icon;
        return $icon;
    }

    public function getTransactionsCountForReport(Collection $transactions, Collection $filteredCategories){
        $categoryIds = $filteredCategories->where('parent_id', '=', $this->id)
                                          ->keys()->push($this->id)->toArray();

        return $transactions->flatten()->whereIn('category_id', $categoryIds)->count();
    }
}
