<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
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

    }

    function render($request, Throwable $exception)
    {
        $env = env('APP_ENV');

        if ($exception instanceof Exception) {
            $message = $env === 'local' ? $exception->getMessage() : 'Internal server error';
            return response()->json(['message' => $message], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        if ($exception instanceof ModelNotFoundException || $exception instanceof NotFoundHttpException) {
            $message = $env === 'local' ? $exception->getMessage() : 'No results found';
            return response()->json(['message' => $message], Response::HTTP_NOT_FOUND);
        }

        if ($exception instanceof QueryException) {
            $message = $env === 'local' ? $exception->getMessage() : 'Internal server error';
            return response()->json(['message' => $message], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
