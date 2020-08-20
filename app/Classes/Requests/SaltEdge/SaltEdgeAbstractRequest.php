<?php


namespace App\Classes\Requests\SaltEdge;


use App\Classes\Requests\AbstractRequest;

abstract class SaltEdgeAbstractRequest extends AbstractRequest
{
    /**
     * @inheritDoc
     */
    function getUrl(): string
    {
        return env('SALT_EDGE_URL').$this->getUrlPart();
    }

    abstract function getUrlPart() : string;

    /**
     * @inheritDoc
     */
    function getHeaders(): array
    {
        return [
            'Accept'        => 'application/json',
            'Content-Type'  => 'application/json',
            'App-id'        => env('SALT_EDGE_APP_ID'),
            'Secret'        => env('SALT_EDGE_SECRET')
        ];
    }
}
