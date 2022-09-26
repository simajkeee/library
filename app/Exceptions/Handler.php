<?php

namespace App\Exceptions;

use App\Models\JsonResponseFailureModel;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (ConnectionException $e, Request $request) {
            if ($this->isApi($request) ) {
                return JsonResponseFailureModel::jsonResponse('Internal server error', Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        });
    }

    private function isApi(Request $request): bool
    {
        return $request->is('api/*');
    }
}
