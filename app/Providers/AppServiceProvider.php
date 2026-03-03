<?php

namespace App\Providers;

use App\Models\Composition;
use App\Policies\CompositionPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Gate::policy(Composition::class, CompositionPolicy::class);
    }
}