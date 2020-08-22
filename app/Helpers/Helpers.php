<?php


namespace App\Helpers;


class Helpers
{
    /**
     * This method checks if app run in command line(cli) mode
     *
     * @return bool
     */
    public static function isCli(){
        return strpos(php_sapi_name(), 'cli') !== false;
    }

    public static function NumberFormat($num)
    {
        return number_format($num, 2, '.', ',');
    }
}
