<?php

namespace ABAPI\Clients;

class AuthClient extends Client
{
    private $token;

    private $baseUri;

    /**
     * Init AuthClient instance
     *
     * @param string $token
     * @param string $baseUri
     */
    public function __construct(string $token, string $baseUri = 'http://go.accountbox.ru/api/v1')
    {
        $this->token = $token;
        $this->baseUri = $baseUri;
    }

    /**
     * Get the base uri
     *
     * @return string
     */
    public function getBaseUri()
    {
        return $this->baseUri;
    }

    /**
     * Get the token
     * 
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }
}