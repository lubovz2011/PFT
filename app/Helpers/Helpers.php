<?php


namespace App\Helpers;

/**
 * Class Helpers
 * This class contains helper functions
 *
 * @package App\Helpers
 */
class Helpers
{
    /**
     * This method checks if app run in command line(cli) mode
     * @return bool
     */
    public static function isCli(){
        return strpos(php_sapi_name(), 'cli') !== false;
    }

    /**
     * Method format a number with grouped thousands
     * @param $num
     * @return string
     */
    public static function NumberFormat($num)
    {
        return number_format($num, 2, '.', ',');
    }
}
