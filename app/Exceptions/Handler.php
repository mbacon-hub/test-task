<?php

namespace App\Exceptions;

use App\Api\V1\Exceptions\BusinessException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

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
        BusinessException::class
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
        $this->renderable(function (BusinessException $e) {
            $code = ($e->getCode() === 0) ? 409 : $e->getCode();

            return response()->json([
                "status" => $code,
                "message" => $e->getMessage(),
                "data" => []
            ], $code);
        });

        $this->renderable(function (NotFoundHttpException $e) {
            return response()->json([
                "status" => 404,
                "message" => "Not found",
                "data" => []
            ], 404);
        });

        $this->renderable(function(ValidationException $e) {
            return response()->json([
                "status" => 400,
                "message" => "Validation error",
                "data" => $e->errors()
            ], 400);
        });
    }
}
