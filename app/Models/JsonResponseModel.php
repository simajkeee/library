<?php

namespace App\Models;

use App\Messages\Exceptions\ResponseCodeExceptionMessages;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class JsonResponseModel
{
    public static function success(array $data, int $code = Response::HTTP_OK): JsonResponse
    {
        $response = (new static())->getJsonResponse([
            'code' => $code,
            'data' => $data,
        ]);
        $response->setStatusCode($code);

        if (!$response->isSuccessful()) {
            throw new \InvalidArgumentException(ResponseCodeExceptionMessages::expectedSuccessCode($code));
        }

        return $response;
    }

    public static function error(string $message, int $code = Response::HTTP_INTERNAL_SERVER_ERROR): JsonResponse
    {
        $response =  (new static())->getJsonResponse([
            'code' => $code,
            'error' => $message,
        ]);
        $response->setStatusCode($code);

        if (!$response->isClientError() && !$response->isServerError()) {
            throw new \InvalidArgumentException(ResponseCodeExceptionMessages::expectedErrorCode($code));
        }

        return $response;
    }

    private function getJsonResponse(array $data): JsonResponse
    {
        return response()->json($data);
    }
}
