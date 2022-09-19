<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Auth\AuthenticationException;


class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof AuthenticationException) {
            return redirect('/');
        }

        if ($exception instanceof \Illuminate\Session\TokenMismatchException) {
            return redirect()->route('login');
        }

        // if($this->isHttpException($exception))
        // {
        //     switch ($exception->getStatusCode())
        //         {
        //         // not found
        //         case 404:
        //         return redirect()->guest('/');
        //         break;

        //         // internal error
        //         case '500':
        //         return redirect()->guest('/');
        //         break;

        //         default:
        //             return $this->renderHttpException($exception);
        //         break;
        //     }
        // }


        return parent::render($request, $exception);
    }
}
