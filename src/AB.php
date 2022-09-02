<?php

namespace ABAPI;

use ABAPI\Clients\{AuthClient, Client};
use ABAPI\Endpoints\ListEndpoint;

class AB
{
    private $collectionEndpoint = [];

    public function __construct(Client $client)
    {
        if (!($client instanceof AuthClient)) {
            return;
        }

        $this->collectionEndpoint = [
            'list' => new ListEndpoint($client)
        ];
    }

    public function get(string $endpoint)
    {
        if (!array_key_exists($endpoint, $this->collectionEndpoint))
            return null;

        return $this->collectionEndpoint[$endpoint];
    }
}