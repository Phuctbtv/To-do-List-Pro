<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Đăng ký middleware 'admin' của bạn
        $middleware->alias([
            'admin' => \App\Http\Middleware\CheckAdmin::class,
        ]);
        
        // Hoặc nếu muốn thêm vào nhóm middleware 'web' (tùy chọn)
        // $middleware->web(append: [
        //     \App\Http\Middleware\CheckAdmin::class,
        // ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();