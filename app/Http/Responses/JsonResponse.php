<?php

namespace App\Http\Responses;

class JsonResponse extends \Illuminate\Http\JsonResponse
{
    /**
     * @param $data
     */
    public function __construct($data = null)
    {
        if (is_array($data)) {
            $data = array_map(fn($entity) => $this->objectWithId($entity), $data);
        } elseif (is_object($data)) {
            $data = $this->objectWithId($data);
        }
        parent::__construct($data);
    }

    public function objectWithId($data): array
    {
        return array_merge(['id' => $data->getId()], $data->toArray());
    }
}
