<?php 

namespace ABAPI\Traits;

use ABAPI\Schemes\HttpRequest;

trait ListEndpointTrait
{
    /**
     * @param int $list_id
     * @param string $fieldName
     * @param string $fieldValue
     * @return HttpRequest
     */
    private function makeUpdateListTargetFieldRequest(int $list_id, string $fieldName, string $fieldValue)
    {
        return new HttpRequest('list', [
            'list_id' => $list_id,
            $fieldName => $fieldValue
        ]);
    }
}