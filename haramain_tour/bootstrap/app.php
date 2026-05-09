<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // --- TAMBAHKAN BARIS INI ---
        $middleware->trustProxies(at: '*'); 
        // ---------------------------

        $middleware->web(append: [
            \App\Http\Middleware\ApplyUserSettings::class,
        ]);
        
        $middleware->alias([
            'admin'        => \App\Http\Middleware\IsAdmin::class,
            'ensure.admin' => \App\Http\Middleware\EnsureAdmin::class,
        ]);
        
        $middleware->validateCsrfTokens(except: [
            '/chatbot/message',
            '/midtrans/callback',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
