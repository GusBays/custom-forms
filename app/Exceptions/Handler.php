<?php

namespace App\Exceptions;

use App\Helpers\Routes;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

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

    public function render($request, Throwable $th)
    {
        if ($th instanceof AuthenticationException) {
            return Routes::isAuthApiMiddleware() ? 
                response()->json(
                    [
                        'code' => 'authentication_required',
                        'error' => 'This resource requires authentication',
                    ],
                Response::HTTP_UNAUTHORIZED, ['WWW-Authenticate' => 'Bearer'])
                :   response()->view('login', ['Unauthenticated' => true]);
        }

        if ($th instanceof ModelNotFoundException) {
            $model = Str::kebab(class_basename($th->getModel()));
            $ids = $th->getIds();
            $formattedIds = is_array($ids) ? implode(',', $ids) : $ids;
            if (blank($formattedIds)) $formattedIds = $request->route('id');
            $message =  "$model not found with id: $formattedIds";

            return response()->json(['error' => $message], Response::HTTP_NOT_FOUND);
        }

        if ($th instanceof ValidationException) {
            return response()->json([
                $th->validator->errors()->getMessages()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if ($th instanceof \Throwable) {
            $message = env('APP_DEBUG') ? $th->getMessage() : 'looks_like_something_wrong';
            $trace = env('APP_DEBUG') ? $th->getTrace() : 'internal_server_error';

            return response()->json([
                'error' => $message,
                'trace' => $trace
            ], $th->getCode());
        }

        parent::render($request, $th);
    }
}
