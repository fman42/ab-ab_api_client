<?php 

namespace ABAPI\Traits;

use ABAPI\Schemes\HttpRequest;

trait ListEndpointTrait
{
    private function makeUpdateListTargetFieldRequest(int $list_id, string $fieldName, string $fieldValue)
    {
        return new HttpRequest('list', [
            'list_id' => $list_id,
            $fieldName => $fieldValue
        ]);
    }
}