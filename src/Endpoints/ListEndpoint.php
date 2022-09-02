<?php

namespace ABAPI\Endpoints;

use ABAPI\Clients\AuthClient;
use ABAPI\Schemes\{HttpRequest, APIResponse};
use ABAPI\Tools\AuthHttpSender;

class ListEndpoint
{
    private $httpSender;

    public function __construct(AuthClient $client)
    {
        $this->httpSender = new AuthHttpSender($client);
    }

    /**
     * Create a mailing list
     *
     * @return APIResponse
     */
    public function createList(string $name, int $messages_count_per_account, int $messages_delay_in_seconds)
    {
        $request = new HttpRequest('/list', [
            'name' => $name,
            'messages_count_per_account' => $messages_count_per_account,
            'messages_delay' => $messages_delay_in_seconds
        ]);
        return $this->httpSender->sendPostRequest($request);
    }

    /**
     * Update list status
     * 
     * @return APIResponse
     */
    public function updateListStatus(int $list_id, string $status)
    {
        $request = new HttpRequest('/list', [
            'list_id' => $list_id,
            'status' => $status
        ]);
        return $this->httpSender->sendPutRequest($request);
    }

    /**
     * Upload phones to list
     * 
     * @return APIResponse
     */
    public function uploadPhones(int $list_id, string $phonesTxtFilePath)
    {
        $request = new HttpRequest('/list/phones', [
            'list_id' => $list_id,
            'phones_txt' => curl_file_create($phonesTxtFilePath)
        ]);
        return $this->httpSender->sendPostRequest($request);
    }
}