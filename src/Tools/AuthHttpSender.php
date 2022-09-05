<?php

namespace ABAPI\Tools;

use ABAPI\Clients\AuthClient;
use ABAPI\Schemes\{HttpRequest, APIResponse};
use GuzzleHttp\Client;

class AuthHttpSender
{
    private $client;

    private $httpClient;

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

    public function sendRequest(HttpRequest $request, string $typeRequest, string $body = 'json') {
        $response = $this->httpClient->request($typeRequest, $request->getUrl(), [$body => $request->getArrayParams()]);
        
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