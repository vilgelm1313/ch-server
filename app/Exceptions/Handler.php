<?php

namespace App\Exceptions;

use App\Services\Log\LoggerService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {

        });
    }

    public function render($request, Throwable $e)
    {
        $exceptionData = null;

        if (!app()->isProduction()) {
            $exceptionData = [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'code' => $e->getCode(),
            ];
        }
        $message = '';
        $data = null;
        $code = null;

        if ($e instanceof NotFoundHttpException) {
            $message = 'Page not found';
            $code = 404;
        } elseif ($e instanceof ModelNotFoundException) {
            $message = 'Item not found';
            $code = 404;
        } elseif ($e instanceof ValidationException) {
            $message = 'Data is not valid';
            $code = 422;
            $data = $e->validator->errors();
        } elseif ($e instanceof AuthorizationException) {
            $message = 'Unauthorized';
            $code = 403;
        } elseif ($e instanceof AuthenticationException) {
            $message = 'Unauthenticated';
            $code = 401;
        } elseif ($e instanceof BusinessException) {
            $message = $e->getMessage();
            $code = $e->getCode();
            $data = $e->getData();
        } elseif ($e instanceof MethodNotAllowedHttpException) {
            $message = 'Not found';
            $code = 404;
            $this->logInTelegram($e);
        } else {
            $message = 'Internal server error';
            $code = 500;
            $this->logInTelegram($e);
        }

        $response = [
            'success' => false,
            'message' => $message,
            'code' => $code,
            'data' => $data,
        ];

        if ($exceptionData) {
            $response['exception'] = $exceptionData;
        }

        return response()->json($response, 200);
    }

    protected function logInTelegram(Throwable $e)
    {
        /**
         * @var LoggerService
         */
        $app = app()->make(LoggerService::class);
        //$app->logException($e);
    }
}
