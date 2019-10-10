<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        switch(get_class($exception)) {
            case 'Illuminate\Auth\Access\AuthorizationException':
                $errorResponse = [
                    'message' => 'Acceso no autorizado',
                    'code' => '403'
                ];
            break;
            case 'Symfony\Component\HttpKernel\Exception\NotFoundHttpException':
                $errorResponse = [
                    'message' => 'Recurso no encontrado',
                    'code' => '404'
                ];
            break;
            case 'Illuminate\Database\Eloquent\ModelNotFoundException':
                $errorResponse = [
                    'message' => 'Documento no encontrado',
                    'code' => '404'
                ];
            break;
            case 'Illuminate\Validation\ValidationException':
                $errorResponse = [
                    'message' => $exception->getMessage(),
                    'data' => $exception->errors(),
                    'code' => '406'
                ];
            break;
            default:
                $errorResponse = [
                    'message' => 'Error no identificado ' . get_class($exception),
                    "data" => $exception->getMessage(),
                    'code' => '500'
                ];
        }

        return response()->json([
            'message' => $errorResponse['message'],
            'data' => isset($errorResponse['data']) ? $errorResponse['data'] : null
        ], $errorResponse['code']);

        return parent::render($request, $exception);
    }
}
