<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AdminLogoutController extends Controller
{
    public function __invoke(): RedirectResponse
    {
        Auth::guard('admin')->logout();

        return redirect(route('admin.login'));
    }
}
