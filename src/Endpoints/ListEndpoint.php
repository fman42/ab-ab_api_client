<?php

namespace ABAPI\Endpoints;

use ABAPI\Clients\AuthClient;
use ABAPI\Schemes\{ABList, HttpRequest, APIResponse};
use ABAPI\Tools\AuthHttpSender;
use ABAPI\Traits\ListEndpointTrait;

class ListEndpoint
{
    use ListEndpointTrait;

    /**
     * @var AuthHttpSender $httpSender
     */
    private $httpSender;

    /**
     * @param AuthClient $client
     * 
     * @return void
     */
    public function __construct(AuthClient $client)
    {
        $this->httpSender = new AuthHttpSender($client);
    }

    /**
     * Создать рассылку
     *
     * @param ABList экземпляр AB-рассылки
     * @return APIResponse
     */
    public function createList(ABList $list)
    {
        $params = [];
        foreach ($list->toArray() as $index => $param) {
            $params[] = [
                'name' => $index,
                'contents' => $param
            ];
        }

        $request = new HttpRequest('list', $params);
        return $this->httpSender->sendRequest($request, 'POST', 'multipart');
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
     * Обновить дедлайн у рассылки
     * 
     * @param itneger list_ID ID рассылки в AccountBox
     * @param string $deadline новый дедлайн
     * @return APIResponse
     */
    public function updateListDeadline(int $list_id, string $deadline)
    {
        $request = $this->makeUpdateListTargetFieldRequest($list_id, 'deadline', $deadline);
        return $this->httpSender->sendRequest($request, 'PUT');
    }

    /**
     * Обновить статус рассылки
     * 
     * @param integer list_id ID рассылки в AccountBox
     * @param string $status статус рассылки
     * @return APIResponse
     */
    public function updateListStatus(int $list_id, string $status)
    {
        $request = $this->makeUpdateListTargetFieldRequest($list_id, 'status', $status);
        return $this->httpSender->sendRequest($request, 'PUT');
    }

    /**
     * Обновить изображение у рассылки
     * 
     * @param integer $list_id ID рассылки в AccountBox
     * @param resource $imageContent изображение
     * @return APIResponse
     */
    public function updateImage(int $list_id, $imageContent)
    {
        $request = new HttpRequest('list', [
            [
                'name' => 'list_id',
                'contents' => $list_id
            ],
            [
                'name' => 'image',
                'contents' => $imageContent
            ]
        ]);
        return $this->httpSender->sendRequest($request, 'PUT', 'multipart');
    }

    /**
     * Загрузить файл номеров в рассылку
     * 
     * @param integer list_id ID рассылки в AccountBox
     * @param string $phonesTxt поток файла с номерами
     * @return APIResponse
     */
    public function uploadPhones(int $list_id, string $phonesTxt)
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