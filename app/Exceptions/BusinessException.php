<?php

namespace App\Exceptions;

class BusinessException extends \Exception
{
    protected const BUSINESS_CODE = 422;

    public function __construct(string $message = '')
    {
        parent::__construct($message, static::BUSINESS_CODE);
    }

    public function getData()
    {
        return [];
    }
}
