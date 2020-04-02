<?php

namespace App\Exceptions;
use Auth;
use App\Error;
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
     * Created By : The vendor
     * Created At : Who knows! ¯\_(ツ)_/¯
     * Summary : Report or log an exception.
     *           This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     * 
     * Updated By : Nilaksha 
     * Updated At : 23-1-2019
     * Summary : Store the exceptions physically in a table as a reference to solve
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception) {

        $userId = 0;
        if (Auth::user()) {
            $userId = Auth::user()->id;
        }

        $data = array(
            'user_id' => $userId,
            'code' => $exception->getCode(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'message' => $exception->getMessage(),
            'trace' => $exception->getTraceAsString(),
        );

        Error::create($data);
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
        return parent::render($request, $exception);
    }
}
