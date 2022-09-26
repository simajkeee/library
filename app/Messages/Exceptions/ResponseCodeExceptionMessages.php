<?php

namespace App\Messages\Exceptions;

class ResponseCodeExceptionMessages
{
    static public function expectedSuccessCode(int $code): string
    {
        return sprintf("Expected response code representing success but provided %d", $code);
    }

    static public function expectedErrorCode(int $code): string
    {
        return sprintf("Expected response code representing error but provided %d", $code);
    }
}
