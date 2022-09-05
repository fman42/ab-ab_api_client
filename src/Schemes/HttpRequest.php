<?php

namespace ABAPI\Schemes;

class HttpRequest
{
    protected $url;

    protected $params = [];

    /**
     * Создать экземпляр объекта HTTP-запроса
     *
     * @param string $url endpoint, куда шлем запрос
     * @param array $params тело запроса
     */
    public function __construct(string $url, array $params)
    {
        $this->url = $url;
        $this->params = $params;
    }

    /**
     * Получить endpoint, куда шлем
     * 
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Получить тело запроса
     * 
     * @return array
     */
    public function getArrayParams()
    {
        return $this->params;
    }
}