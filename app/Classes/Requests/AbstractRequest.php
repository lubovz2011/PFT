<?php


namespace App\Classes\Requests;


use GuzzleHttp\Client;

/**
 * Class AbstractRequest
 * @package App\Classes\Requests
 */
abstract class AbstractRequest
{
    const METHOD_POST = 'POST';
    const METHOD_GET = 'GET';
    const METHOD_DEL = 'DELETE';

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
     * Function execute http request
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function send(){
        $client = new Client();
        $response = $client->request($this->getMethod(), $this->getUrl(), [
           'body'    => $this->getBody(),
           'headers' => $this->getHeaders()
        ]);
        $this->parseResponse($response->getBody()->getContents());
    }

    abstract function parseResponse(string $data);
}
