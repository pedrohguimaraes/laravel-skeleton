<?php

namespace App\Exceptions\Etc;

use Exception;

class UndefinedMethodException extends Exception
{
    public function __construct(string $class, string $method)
    {
        $this->message = "Call to undefined method $class::$method()";
    }
}
