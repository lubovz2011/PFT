<?php


namespace App\Classes\Requests\IsraelBank;

/**
 * Class ProviderFactory
 * This class create suitable object for given provider
 *
 * @package App\Classes\Requests\IsraelBank
 * @uses \App\Classes\Requests\IsraelBank\Otsar
 */
class ProviderFactory
{
    private static $providers = [
        'otsar' => Otsar::class
    ];

    /**
     * Static method create and return suitable object for given provider
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
