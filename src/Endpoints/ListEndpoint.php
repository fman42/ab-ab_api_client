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
     * Создать рассылку
     *
     * @param string $name название рассылки
     * @param integer $messages_count_per_account количество сообщений на 1 аккаунт
     * @param integer $messages_delay_in_seconds задержка между отправкой в секундах
     * @param string $text текст рассылки
     * @return APIResponse
     */
    public function createList(string $name, int $messages_count_per_account, int $messages_delay_in_seconds, string $text)
    {
        $request = new HttpRequest('list', [
            'name' => $name,
            'messages_count_per_account' => $messages_count_per_account,
            'messages_delay' => $messages_delay_in_seconds,
            'text' => $text
        ]);
        return $this->httpSender->sendRequest($request, 'POST');
    }

    /**
     * Получить рассылку по ID
     * 
     * @param integer $id ID рассылки в AccountBox
     * @return APIResponse
     */
    public function getList(int $id)
    {
        $request = new HttpRequest("list/{$id}", []);
        return $this->httpSender->sendRequest($request, 'GET');
    }

    /**
     * Получить статус сообщения в рассылке по номеру телефона 
     * 
     * @param integer $list_id ID рассылки в AccountBox
     * @param string $phone номер телефона
     * @return APIResponse
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
     * @param integer list_id ID рассылки в AccountBox
     * @param string $status статус рассылки
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
     * Загрузить файл номеров в рассылку
     * 
     * @param integer list_id ID рассылки в AccountBox
     * @param resource $phonesTxt поток файла с номерами
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