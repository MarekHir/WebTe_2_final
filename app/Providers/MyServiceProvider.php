<?php

namespace App\Providers;

use App\Services\LatexParseService;
use Illuminate\Support\ServiceProvider;

class MyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        app()->singleton(LatexParseService::class);
    }
}
