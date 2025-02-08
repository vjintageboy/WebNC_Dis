<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider

{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // Định nghĩa các policies ở đây
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Định nghĩa các gates ở đây nếu cần
        Gate::define('manage-courses', function ($user) {
            return $user->hasRole('instructor');
        });

        Gate::define('enroll-courses', function ($user) {
            return $user->hasRole('student');
        });
    }
}