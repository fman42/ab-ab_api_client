<?php

namespace ABAPI\Clients;

class AuthClient extends Client
{
    private $token;

    private $baseUri;

    /**
     * Создать экземпляр объекта
     *
     * @param string $token API-токен
     * @param string $baseUri базовый адрес API
     */
    public function __construct(string $token, string $baseUri = 'http://go.accountbox.ru/api/v1/')
    {
        $this->token = $token;
        $this->baseUri = $baseUri;
    }

    /**
     * Получить базовый адрес API
     *
     * @return string
     */
    public function getBaseUri()
    {
        return $this->baseUri;
    }

    /**
     * Получить токен
     * 
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }
}