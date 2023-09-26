<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (request()->segment(1) === 'admin') {
            return $request->expectsJson() ? null : route('admin.login');
        }else{
            return $request->expectsJson() ? null : route('login');
        }
    }
}
