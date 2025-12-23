<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        if (!Auth::user()->isAdmin()) {
            // User thường cố vào admin -> redirect về tasks với thông báo
            return redirect()->route('tasks.index')->with('error', 'Access denied! Admin only.');
        }
        
        return $next($request);
    }
}