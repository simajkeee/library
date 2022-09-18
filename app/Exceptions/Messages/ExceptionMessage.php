<?php

class ExceptionMessage
{
    static public function noApiKey(string $className) {
        return sprintf('API key is not provided for %s service', $className);
    }
}
