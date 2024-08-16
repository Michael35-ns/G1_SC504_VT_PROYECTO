<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        using: function () {
            Route::middleware(['web'])
                ->prefix('auth')
                ->group(base_path('routes/auth.php'));

            Route::middleware(['web'])
                ->prefix('gastos')
                ->group(base_path('routes/gastos.php'));

            Route::middleware(['web'])
                ->prefix('home')
                ->group(base_path('routes/web.php'));

            Route::middleware(['web'])
                ->prefix('ingresos')
                ->group(base_path('routes/ingresos.php'));

            Route::middleware(['web'])
                ->prefix('obj-financieros')
                ->group(base_path('routes/objfinancieros.php'));
        },
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
