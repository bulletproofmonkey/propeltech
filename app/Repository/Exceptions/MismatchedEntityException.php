<?php

namespace App\Repository\Exceptions;

use Exception;

class MismatchedEntityException extends Exception
{
    public function __construct(string $expected, string $given)
    {
        parent::__construct(sprintf("Given %s when expected %s", $expected, $given));
    }
}
