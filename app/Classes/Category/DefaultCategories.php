<?php


namespace App\Classes\Category;


use App\Classes\Defaults;
use App\Models\Category;
use App\Models\User;
use phpDocumentor\Reflection\Types\Boolean;

/**
 * Class DefaultCategories
 * This class contains methods that allow us set defaults for user categories
 *
 * @package App\Classes\Category
 */
class DefaultCategories extends Defaults
{
    /**
     * Static method generate default categories
     * @param User $user
     */
    public static function generate(User $user)
    {
        $parent_id = self::generateCategory($user, 'Home', 'fas fa-home');
        self::generateCategory($user, 'Home Services', '', $parent_id);
        self::generateCategory($user, 'Decoration', '', $parent_id);
        self::generateCategory($user, 'Home Supplies', '', $parent_id);

        $parent_id = self::generateCategory($user, 'Kids', 'fas fa-child');
        self::generateCategory($user, 'Education', '', $parent_id);
        self::generateCategory($user, 'Group Activities', '', $parent_id);
        self::generateCategory($user, 'Savings Plan', '', $parent_id);

        $parent_id = self::generateCategory($user, 'Bills', 'fas fa-file-invoice-dollar');
        self::generateCategory($user, 'Internet', '', $parent_id);
        self::generateCategory($user, 'Phone', '', $parent_id);
        self::generateCategory($user, 'Rent', '', $parent_id);

        $parent_id = self::generateCategory($user, 'Tax & Fees', 'fas fa-coins');
        self::generateCategory($user, 'Bank Fees', '', $parent_id);
        self::generateCategory($user, 'Service Fee', '', $parent_id);
        self::generateCategory($user, 'Taxes', '', $parent_id);

        $parent_id = self::generateCategory($user, 'Income', 'fas fa-hand-holding-usd');
        self::generateCategory($user, 'Salary', '', $parent_id);
        self::generateCategory($user, 'Bonus', '', $parent_id);
        self::generateCategory($user, 'Investment Income', '', $parent_id);

        $parent_id = self::generateCategory($user, 'Health & Fitness', 'fas fa-heartbeat');
        self::generateCategory($user, 'Fitness & Sport', '', $parent_id);
        self::generateCategory($user, 'Healthcare', '', $parent_id);
        self::generateCategory($user, 'Personal Care', '', $parent_id);

        $parent_id = self::generateCategory($user, 'Pets', 'fas fa-paw');
        self::generateCategory($user, 'Food', '', $parent_id);
        self::generateCategory($user, 'Vet & Healthcare', '', $parent_id);
        self::generateCategory($user, 'Toys', '', $parent_id);

        $parent_id = self::generateCategory($user, 'Education', 'fas fa-user-graduate');
        self::generateCategory($user, 'Tuition', '', $parent_id);
        self::generateCategory($user, 'Books & Supplies', '', $parent_id);

        $parent_id = self::generateCategory($user, 'Dining Out', 'fas fa-glass-cheers');
        self::generateCategory($user, 'Alcohol & Bars', '', $parent_id);
        self::generateCategory($user, 'Cafes & Restaurants', '', $parent_id);
        self::generateCategory($user, 'Fast Food', '', $parent_id);

        $parent_id = self::generateCategory($user, 'Groceries', 'fas fa-shopping-basket');
        self::generateCategory($user, 'Fruits & Vegetables', '', $parent_id);
        self::generateCategory($user, 'Meat & Fish', '', $parent_id);
        self::generateCategory($user, 'Milk Products', '', $parent_id);

        $parent_id = self::generateCategory($user, 'Transportation', 'fas fa-car');
        self::generateCategory($user, 'Car Rental', '', $parent_id);
        self::generateCategory($user, 'Fuel', '', $parent_id);
        self::generateCategory($user, 'Parking', '', $parent_id);
        self::generateCategory($user, 'Public Transportation', '', $parent_id);
        self::generateCategory($user, 'Service & Parts', '', $parent_id);

        $parent_id = self::generateCategory($user, 'Travel', 'fas fa-plane');
        self::generateCategory($user, 'Hotels', '', $parent_id);
        self::generateCategory($user, 'Transportation', '', $parent_id);
        self::generateCategory($user, 'Vacation', '', $parent_id);

        $parent_id = self::generateCategory($user, 'Entertainments', 'fas fa-gamepad');
        self::generateCategory($user, 'Games & Apps', '', $parent_id);
        self::generateCategory($user, 'Movies & Music', '', $parent_id);

        $parent_id = self::generateCategory($user, 'Shopping', 'fas fa-shopping-bag');
        self::generateCategory($user, 'Clothing', '', $parent_id);
        self::generateCategory($user, 'Electronics & Software', '', $parent_id);
        self::generateCategory($user, 'Sporting Goods', '', $parent_id);

        $parent_id = self::generateCategory($user, 'Gifts & Donations', 'fas fa-gifts');
        self::generateCategory($user, 'Charity', '', $parent_id);
        self::generateCategory($user, 'Gifts', '', $parent_id);

        $parent_id = self::generateCategory($user, 'Miscellaneous', 'fas fa-list');

        $parent_id = self::generateCategory($user, 'Banks & Cards', 'far fa-credit-card', null, true);
    }

    /**
     * Static method inserts the category into the database
     *
     * @param User $user
     * @param string $name
     * @param string $icon
     * @param int|null $parent_id
     * @param bool $lock
     * @return int
     */
    public static function generateCategory(User $user, string $name, string $icon, int $parent_id = null, bool $lock = false)
    {
        $category = new Category();
        $category->name = $name;
        $category->icon = $icon;
        $category->parent_id = $parent_id;
        $category->lock = $lock;
        $user->categories()->save($category);
        return $category->id;
    }
}
