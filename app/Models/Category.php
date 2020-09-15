<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * This class represent record from categories table
 *
 * @property integer $id
 * @property string $name
 * @property integer $parent_id
 * @property boolean $status
 * @property string $icon
 * @property integer $user_id
 * @property Category[] $categories
 * @property Category $category
 * @property boolean $lock
 *
 * @package App\Models
 */
class Category extends Model
{
    public $timestamps = false;

    /**
     * Define relation - Category belongs to User
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Define relation - Category has many Categories
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * Define relation - Category belongs to Category
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    /**
     * Define relation - Category has many Transactions
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::Class);
    }

    /**
     * Method return:
     *      icon - for parent category
     *      parent icon - for child category
     * @param $icon
     * @return string
     */
    public function getIconAttribute($icon)
    {
        if(!empty($this->parent_id))
            return $this->category->icon;
        return $icon;
    }

    /**
     * Method return count of transactions in current category and her subCategories
     * @param Collection $transactions
     * @param Collection $filteredCategories
     * @return int
     */
    public function getTransactionsCountForReport(Collection $transactions, Collection $filteredCategories)
    {
        return $this->getCategoryTransactions($transactions, $filteredCategories)
                    ->count();
    }

    /**
     * Method return amount of transactions in current category and her subCategories
     * @param Collection $transactions
     * @param Collection $filteredCategories
     * @return mixed
     */
    public function getAmountForReport(Collection $transactions, Collection $filteredCategories)
    {
        return $this->getCategoryTransactions($transactions, $filteredCategories)
                    ->sum('amountInUserCurrency');
    }

    /**
     * Method return transactions percent for current category
     * @param Collection $transactions
     * @param Collection $filteredCategories
     * @param $totalIncome
     * @param $totalExpense
     * @return float|int
     */
    public function getPercentForReport(Collection $transactions, Collection $filteredCategories, $totalIncome, $totalExpense)
    {
        $totalCategoryAmount = $this->getAmountForReport($transactions, $filteredCategories);

        return $totalCategoryAmount * 100 / ($totalCategoryAmount >= 0 ? $totalIncome : $totalExpense);
    }

    /**
     * Method return transactions percent for one subCategory
     * @param Collection $transactions
     * @param Collection $filteredCategories
     * @param Category $subCategory
     * @return float|int
     */
    public function getChildPercentForReport(Collection $transactions, Collection $filteredCategories, Category $subCategory)
    {
        $categoryTransactions = $this->getCategoryTransactions($transactions, $filteredCategories);
        $subCategoryAmount = $subCategory->getAmountForReport($transactions,$filteredCategories);
        $type = $subCategoryAmount >= 0 ? 'income' : 'expense';

        $parentCategoryAmount = $categoryTransactions->where('type', '=', $type)
                                                     ->sum('amountInUserCurrency');
        if($parentCategoryAmount)
            return 100 * $subCategoryAmount / $parentCategoryAmount;
        else
            return 0;
    }

    /**
     * Method return all transactions that was made with current category and all sub-categories
     * @param Collection $transactions
     * @param Collection $filteredCategories
     * @return Collection
     */
    private function getCategoryTransactions(Collection $transactions, Collection $filteredCategories)
    {
        //get all subCategory ids
        $categoryIds = $filteredCategories->where('parent_id', '=', $this->id)
                                          ->keys()
                                          ->toArray();

        //add current category id to array of subCategory ids
        $categoryIds[] = $this->id;

        //find and return transactions where category id of each transaction exists in array of category ids
        return $transactions->whereIn('category_id', $categoryIds);
    }
}
