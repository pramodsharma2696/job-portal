<?php

namespace App\Providers;


use App\Models\Skill;
use App\Services\JobServices;
use App\Services\SkillServices;
use App\Repositories\JobRepository;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Vite;
use App\Repositories\SkillRepository;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Services\Interfaces\JobServicesInterface;
use App\Services\Interfaces\SkillServicesInterface;
use App\Repositories\Interfaces\JobRepositoryInterface;
use App\Repositories\Interfaces\SkillRepositoryInterface;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
   
    
    public function register(): void
    {
        Schema::defaultStringLength(191);
        $this->app->bind(SkillRepositoryInterface::class, SkillRepository::class);
        $this->app->bind(SkillServicesInterface::class, SkillServices::class);
        $this->app->bind(JobRepositoryInterface::class, JobRepository::class);
        $this->app->bind(JobServicesInterface::class, JobServices::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);
        
        Gate::before(function ($user, $ability) {
            return $user->hasRole('admin') ? true : null;
        });
    }
}
