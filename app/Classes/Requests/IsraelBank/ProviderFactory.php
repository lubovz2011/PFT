<?php


namespace App\Classes\Requests\IsraelBank;
use App\Classes\Requests\IsraelBank\Otsar;
/**
 * Class ProviderFactory
 * @package App\Classes\Requests\IsraelBank
 * @uses \App\Classes\Requests\IsraelBank\Otsar
 */
class ProviderFactory
{
    private static $providers = [
        'otsar' => Otsar::class
    ];

    /**
     * Function create and return suitable object for given provider
     *
     * @param string $providerName
     * @return mixed
     * @throws \Exception
     */
    public static function provider(string $providerName)
    {
        if(isset(self::$providers[strtolower($providerName)]))
            return new self::$providers[strtolower($providerName)]();

        throw new \Exception('Unexpected provider '.$providerName);
    }

}
