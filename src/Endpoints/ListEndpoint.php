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
        $request = new HttpRequest('list', [
            'name' => $name,
            'messages_count_per_account' => $messages_count_per_account,
            'messages_delay' => $messages_delay_in_seconds
        ]);
        return $this->httpSender->sendRequest($request, 'POST');
    }

    /**
     * Get the mailing list by id
     * 
     * @return APIResponse
     */
    public function getList(int $id)
    {
        $request = new HttpRequest("list/{$id}", []);
        return $this->httpSender->sendRequest($request, 'GET');
    }

    /**
     * Get the status of message to phone in list
     */
    public function getPhoneStatus(int $list_id, string $phone)
    {
        $request = new HttpRequest("phone/status", [
            'list_id' => $list_id,
            'phone' => $phone
        ]);
        return $this->httpSender->sendRequest($request, 'GET');
    }

    /**
     * Update list status
     * 
     * @return APIResponse
     */
    public function updateListStatus(int $list_id, string $status)
    {
        $request = new HttpRequest('list', [
            'list_id' => $list_id,
            'status' => $status
        ]);
        return $this->httpSender->sendRequest($request, 'PUT');
    }

    /**
     * Upload phones to list
     * 
     * @return APIResponse
     */
    public function uploadPhones(int $list_id, $phonesTxt)
    {
        $request = new HttpRequest('list/phones', [
            [
                'name' => 'phones_txt',
                'contents' => $phonesTxt
            ],
            [
                'name' => 'list_id',
                'contents' => $list_id
            ]
        ]);
        return $this->httpSender->sendRequest($request, 'POST', 'multipart');
    }
}