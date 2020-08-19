<?php


namespace App\Classes\Utils;


class DataSets
{
    /**
     * Method return array with dates
     *
     * @return string[]
     */
    public static function getDateOptions()
    {
        return [
            1 => 'Today',
            2 => 'Yesterday',
            3 => 'Last 7 days',
            4 => 'Last 30 days',
            5 => 'This Month',
            6 => 'Last Month'
        ];
    }

    public static function getTypeOptions()
    {
        return [
            'income' => 'Income',
            'expense' => 'Expense'
        ];
    }


}
