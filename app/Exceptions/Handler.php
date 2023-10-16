<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Auth\AuthenticationException;
use App\Providers\RouteServiceProvider;

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
            //
        });
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthenticated.'
            ], 401);
        }

        if ($request->is('admin') || $request->is('admin/*')) {
            return redirect(RouteServiceProvider::ADMIN);
        }

        if ($request->is('super') || $request->is('super/*')) {
            return redirect(RouteServiceProvider::SUPER);
        }

        if ($request->is('senior') || $request->is('senior/*')) {
            return redirect(RouteServiceProvider::SENIOR);
        }

        if ($request->is('master') || $request->is('master/*')) {
            return redirect(RouteServiceProvider::MASTER);
        }
        
        if ($request->is('agent') || $request->is('agent/*')) {
            return redirect(RouteServiceProvider::AGENT);
        }
        
        return redirect()->guest(route('login'));
    }
}
