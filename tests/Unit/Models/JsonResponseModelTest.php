<?php

namespace Tests\Unit\Models;

use App\Models\JsonResponseModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Tests\TestCase;

class JsonResponseModelTest extends TestCase
{
    public function test_success_method_returns_json_response_object() {
        $this->assertInstanceOf(JsonResponse::class, JsonResponseModel::success([]));
    }

    public function test_success_method_returns_200_code_by_default()
    {
        $responseData = JsonResponseModel::success([])->getData();
        $code = $responseData->code ?? false;
        $this->assertEquals(Response::HTTP_OK, $code);
    }

    /**
     * @dataProvider success_method_provided_with_error_code_throw_exception_provider
     */
    public function test_success_method_provided_with_error_code_throw_exception(array $data, int $code)
    {
        $this->expectException(\InvalidArgumentException::class);

        JsonResponseModel::success($data, $code);
    }

    public function test_error_method_returns_500_code_by_default()
    {
        $responseData = JsonResponseModel::error('')->getData();
        $code = $responseData->code ?? false;
        $this->assertEquals(Response::HTTP_INTERNAL_SERVER_ERROR, $code);
    }

    public function test_error_method_returns_json_response_object() {
        $this->assertInstanceOf(JsonResponse::class, JsonResponseModel::error(''));
    }

    /**
     * @dataProvider error_method_provided_with_success_code_throw_exception_provider
     */
    public function test_error_method_provided_with_success_code_throw_exception(string $message, int $code)
    {
        $this->expectException(\InvalidArgumentException::class);

        JsonResponseModel::error($message, $code);
    }

    public function error_method_provided_with_success_code_throw_exception_provider()
    {
        return [
            ['', Response::HTTP_OK],
            ['', Response::HTTP_IM_USED],
            ['', Response::HTTP_MULTIPLE_CHOICES],
            ['', Response::HTTP_PERMANENTLY_REDIRECT],
        ];
    }

    public function success_method_provided_with_error_code_throw_exception_provider()
    {
        return [
            [[], Response::HTTP_BAD_REQUEST],
            [[], Response::HTTP_UNAVAILABLE_FOR_LEGAL_REASONS],
            [[], Response::HTTP_INTERNAL_SERVER_ERROR],
            [[], Response::HTTP_NETWORK_AUTHENTICATION_REQUIRED],
        ];
    }
}
