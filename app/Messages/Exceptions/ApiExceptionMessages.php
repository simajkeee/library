<?php

namespace App\Messages\Exceptions;


class ApiExceptionMessages
{
    static public function noApiKey(string $className): string
    {
        return sprintf('API key is not provided for %s service', $className);
    }

    static public function requiredParams(array $params): string
    {
        return sprintf("Required parameters are not provided: %s", implode(", ", $params));
    }

    static public function unableToAccessUrl(string $url): string
    {
        return sprintf("Unable to access url: %s", $url);
    }
}
