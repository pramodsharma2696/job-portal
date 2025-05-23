<?php

namespace App\Providers;

use App\Models\Skill;
use App\Models\JobPost;
use App\Policies\JobPostPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    protected $policies = [
        JobPost::class => JobPostPolicy::class,
        Skill::class => SkillPolicy::class,
    ];

    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::before(function ($user, $ability) {
            return $user->hasRole('admin') ? true : null;
        });
    }
}
