<?php

namespace ABAPI\Tools;

use ABAPI\Clients\AuthClient;
use ABAPI\Schemes\{HttpRequest, APIResponse};
use GuzzleHttp\Client;

class AuthHttpSender
{
    /**
     * @var AuthClient
     */
    private $client;

    /**
     * @var Client
     */
    private $httpClient;

    /**
     * @param AuthClient $client
     */
    public function __construct(AuthClient $client)
    {
        $this->client = $client;
        $this->httpClient = new Client([
            'base_uri' => $this->client->getBaseUri(),
            'headers' => [
                'Authorization' => 'Bearer '.$client->getToken()
            ]
        ]);
    }

    /**
     * Отправить HTTP-запрос к API
     * 
     * @param HttpRequest экземпляр объекта HTTP-запроса
     * @param string $typeRequest тип запроса
     * @param string $body тип тела запроса
     * @return APIResponse
     */
    public function sendRequest(HttpRequest $request, string $typeRequest, string $body = 'json') {
        $url = $request->getUrl();
        if ($typeRequest === 'PUT' && $body === 'multipart') {
            $typeRequest = 'POST';
            $url = $url . "?_method=PUT";
        }

        $response = $this->httpClient->request($typeRequest, $url, [$body => $request->getArrayParams()]);
        
        $res = new APIResponse();
        $res->result = true;
        $res->data = json_decode((string) $response->getBody());
        $res->http_code = $response->getStatusCode();

        if ($res->http_code !== 200 && $res->http_code !== 201) {
            $res->result = false;
        }

        return $res;
    }
}