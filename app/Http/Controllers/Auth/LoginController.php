<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Xử lý redirect sau khi login
     */
    protected function redirectTo()
    {
        if (auth()->check()) {
            return auth()->user()->isAdmin() 
                ? route('admin.dashboard')
                : route('tasks.index');
        }
        return route('login');
    }
}