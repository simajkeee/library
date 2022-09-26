<?php

namespace App\Models;

use Illuminate\Http\JsonResponse;

abstract class AbstractJsonResponse
{
    public function __construct(public $data, public int $code)
    {
    }

    public static function jsonResponse($data, int $code): JsonResponse
    {
        return (new static($data, $code))->getJsonResponse();
    }

    public function getJsonResponse(): JsonResponse
    {
        return response()->json($this->toArray());
    }

    abstract public function toArray(): array;
}
