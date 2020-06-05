<?php


namespace App\DefaultData;


use App\Models\Category;
use App\Models\User;

class DefaultCategories extends Defaults
{
    /**
     * generate default categories for new user
     * @param User $user
     */
    public static function generate(User $user)
    {
        self::generateCategory($user, 'Bills', 'fas fa-file-invoice-dollar');
        self::generateCategory($user, 'Tax & Fees', 'fas fa-coins');
    }

    private static function generateCategory(User $user, string $name, string $icon)
    {
        $category = new Category();
        $category->name = $name;
        $category->icon = $icon;
        $user->categories()->save($category);
    }

}
