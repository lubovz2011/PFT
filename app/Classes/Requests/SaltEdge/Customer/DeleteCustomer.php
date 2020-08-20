<?php


namespace App\Classes\Requests\SaltEdge\Customer;


use App\Classes\Requests\SaltEdge\SaltEdgeAbstractRequest;

class DeleteCustomer extends SaltEdgeAbstractRequest
{
    private $identifier;

    function getBody(): string
    {
        return "";
    }

    function getMethod(): string
    {
        return self::METHOD_DEL;
    }

    function parseResponse(string $data)
    {
    }

    function getUrlPart(): string
    {
        return '/customers/'.$this->identifier;
    }

    /**
     * @param mixed $identifier
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
        return $this;
    }
}
