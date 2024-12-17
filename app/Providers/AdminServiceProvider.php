<?php

namespace App\Providers;

use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Http\Kernel;

class AdminServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app['router']->aliasMiddleware('admin', AdminMiddleware::class);
    }
} 