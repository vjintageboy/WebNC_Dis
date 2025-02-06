<?php

namespace App\Providers;
use App\Models\Role;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        // Sửa lại cách binding Role
        $this->app->singleton('role', function ($app) {
            return new Role();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
    protected $policies = [
        Course::class => CoursePolicy::class,
    ];
}
