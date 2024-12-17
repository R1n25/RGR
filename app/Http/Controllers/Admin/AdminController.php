<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!auth()->user()->is_admin) {
                return redirect('/')->with('error', 'Доступ запрещен');
            }
            return $next($request);
        });
    }
} 