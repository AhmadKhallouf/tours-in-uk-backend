<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e): \Illuminate\Http\Response|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|HttpResponse
    {
        if ($request->expectsJson() || $request->is('api/*')) {
            return $this->renderInJsonFormat($request, $e);
        }

        return parent::render($request, $e);
    }

    public function renderInJsonFormat($request, Throwable $e): \Illuminate\Http\JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $e->getMessage(),
        ];

        $status = $this->getStatusBasedOnException($e);

        // return validation errors in case of validation exception
        if ($e instanceof ValidationException) {
            $response['errors'] = $e->errors();
        }

        // add debug information
        if (config('app.debug')) {
            $response['debug'] = $this->getDebugInfo($e);
        }

        return response()->json($response, $status);
    }

    private function getDebugInfo(Throwable $e): array
    {
        $basePath = base_path();

        return [
            'error' => class_basename(get_class($e)),
            'file' => str_starts_with($e->getFile(), $basePath) ? substr($e->getFile(), strlen($basePath)) : $e->getFile(),
            'line' => $e->getLine(),
            'trace' => collect($e->getTrace())->map(function ($trace) use ($basePath) {
                return array_filter([
                    'file' => isset($trace['file']) && str_starts_with($trace['file'], $basePath) ? substr($trace['file'], strlen($basePath)) : $trace['file'] ?? null,
                    'line' => $trace['line'] ?? null,
                    'function' => $trace['function'] ?? null,
                    'class' => $trace['class'] ?? null,
                    'type' => $trace['type'] ?? null,
                ]);
            })->all(),
        ];
    }

    private function getStatusBasedOnException(Throwable $e)
    {
        if ($e instanceof ModelNotFoundException) {
            $status = HttpResponse::HTTP_NOT_FOUND;
        } elseif ($e instanceof NotFoundHttpException) {
            $status = HttpResponse::HTTP_NOT_FOUND;
        } elseif ($e instanceof MethodNotAllowedHttpException) {
            $status = HttpResponse::HTTP_METHOD_NOT_ALLOWED;
        } elseif ($e instanceof AuthorizationException) {
            $status = HttpResponse::HTTP_FORBIDDEN;
        } elseif ($e instanceof AuthenticationException) {
            $status = HttpResponse::HTTP_UNAUTHORIZED;
        } elseif ($e instanceof ValidationException) {
            $status = $e->status;
        } elseif ($e instanceof TokenMismatchException) {
            $status = HttpResponse::HTTP_FORBIDDEN;
        } elseif (method_exists($e, 'getStatusCode')) {
            // For exceptions that are instances of HttpException
            $status = $e->getStatusCode();
        } else {
            // Default to internal server error
            $status = HttpResponse::HTTP_INTERNAL_SERVER_ERROR;
        }
        return $status;
    }
}
