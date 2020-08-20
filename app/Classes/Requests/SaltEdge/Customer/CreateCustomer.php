<?php


namespace App\Classes\Requests\SaltEdge\Customer;


use App\Classes\Requests\SaltEdge\SaltEdgeAbstractRequest;
use App\Models\User;

class CreateCustomer extends SaltEdgeAbstractRequest
{
    /**
     * @var User
     */
    private $user;

    function getBody(): string
    {
        return json_encode([
            'data' => [
                'identifier' => $this->user->login
            ]
        ]);
    }

    function getMethod(): string
    {
        return self::METHOD_POST;
    }

    function getUrlPart(): string
    {
        return '/customers';
    }

    function parseResponse(string $data)
    {
        $data = json_decode($data);
        $this->user->identifier = $data->data->id;
        $this->user->save();
    }

    /**
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }

}
