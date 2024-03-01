<?php

namespace App\Repository\Exceptions;

use Exception;

class NotFoundException extends Exception
{
    public function __construct(string $class, int $id)
    {
        parent::__construct(sprintf("Unable to find %s with an id of  %d", $class, $id));
    }
}
