<?php

namespace App\Repository;

use App\Models\Address;

/**
 * @method Address get(int $id)
 */
class AddressRepository extends JsonRespository
{
    /**
     * @return string
     */
    protected function getClass(): string
    {
        return Address::class;
    }
}
