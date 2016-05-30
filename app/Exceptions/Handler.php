<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    protected $exceptionHttpStatusMap = [
        ModelNotFoundException::class => 404
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        // If the request wants JSON (AJAX doesn't always want JSON)
        if ($request->wantsJson())
        {
            // Define the response
            $response = ['errors' => 'Sorry, something went wrong.'];

            // get the exception class
            $e_class = get_class($e);

            // If the app is in debug mode
            if (config('app.debug'))
            {
                // Add the exception class name, message and stack trace to response
                $response['exception'] = $e_class; // Reflection might be better here
                $response['message'] = $e->getMessage();
                $response['trace'] = $e->getTrace();
            }

            if (array_key_exists($e_class, $this->exceptionHttpStatusMap))
            {
                $status = $this->exceptionHttpStatusMap[$e_class];
            }
            else
            {
                // Default response of 400
                $status = 400;

                if ($this->isHttpException($e))
                {
                    $status = $e->getStatusCode();
                }
            }

            // Return a JSON response with the response array and status code
            return response()->json($response, $status);
        }

        // Default to the parent class' implementation of handler
        return parent::render($request, $e);
    }
}
