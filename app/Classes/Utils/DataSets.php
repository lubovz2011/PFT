<?php


namespace App\Classes\Utils;


use App\Models\User;

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

    /**
     * Method return array with types
     *
     * @return string[]
     */
    public static function getTypeOptions()
    {
        return [
            'income' => 'Income',
            'expense' => 'Expense'
        ];
    }

    /**
     * Method return array with default currencies
     *
     * @return string[]
     */
    public static function getCurrencyOptions()
    {
        return [
            'ILS' => 'ILS Israeli new shekel',
            'USD' => 'USD United States Dollar',
            'EUR' => 'EUR Euro',
            'GBP' => 'GBP British pound',
            'JPY' => 'JPY Japanese yen'
        ];
    }

    /**
     * Method return array with selected currencies by user in settings
     *
     * @return string[]
     */
    public static function getUserCurrencyOptions()
    {
        $user = auth()->user();
        $defaultCurrencies = self::getCurrencyOptions();
        $userCurrencies = explode(',', $user->currencies ?: "");
        array_unshift($userCurrencies, $user->currency);
        $userCurrencies = array_unique($userCurrencies);

        return array_intersect_key($defaultCurrencies, array_flip($userCurrencies));
    }
}
