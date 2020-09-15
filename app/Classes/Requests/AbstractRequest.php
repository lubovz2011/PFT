<?php


namespace App\Classes\Requests;


use App\Classes\Requests\IsraelBank\Otsar;
use GuzzleHttp\Client;

/**
 * Class AbstractRequest
 * This class handle all http requests outside the system
 *
 * @package App\Classes\Requests
 */
abstract class AbstractRequest
{
    const METHOD_POST = 'POST';
    const METHOD_GET = 'GET';
    const METHOD_DEL = 'DELETE';

    private static $providers = [
        'otsar' => Otsar::class
    ];

    /**
     * Function returns request url
     * @return string
     */
    abstract function getUrl() : string;

    /**
     * Function returns request headers
     * @return array
     */
    abstract function getHeaders() : array;

    /**
     * Function returns request body
     * @return string
     */
    abstract function getBody();

    /**
     * Function returns request method (get/post...)
     * @return string
     */
    abstract function getMethod() : string;

    /**
     * Function handle response data
     * @param string $data
     * @return mixed
     */
    abstract function parseResponse(string $data);

    /**
     * Function execute http request
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function send()
    {
        $client = new Client();
        $response = $client->request($this->getMethod(), $this->getUrl(), [
           'body'    => $this->getBody(),
           'headers' => $this->getHeaders()
        ]);
        $this->parseResponse($response->getBody()->getContents());
    }

    /**
     * Static method create and return suitable object for given provider (factory method)
     * @param string $providerName
     * @return AbstractRequest
     * @throws \Exception
     */
    public static function provider(string $providerName)
    {
        if(isset(self::$providers[strtolower($providerName)]))
            return new self::$providers[strtolower($providerName)]();

        throw new \Exception('Unexpected provider '.$providerName);
    }
}
