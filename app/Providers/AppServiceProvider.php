<?php

namespace App\Providers;

use App\Services\ChallengeService;
use App\Services\Contracts\IChallengeService;
use App\Services\Contracts\IUserService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        IUserService::class => UserService::class,
        IChallengeService::class => ChallengeService::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
