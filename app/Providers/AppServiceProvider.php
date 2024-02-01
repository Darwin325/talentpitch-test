<?php

namespace App\Providers;

use App\Services\ChallengeService;
use App\Services\CompanyService;
use App\Services\Contracts\IChallengeService;
use App\Services\Contracts\ICompanyService;
use App\Services\Contracts\IProgramService;
use App\Services\Contracts\IUserService;
use App\Services\ProgramService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        IUserService::class => UserService::class,
        IChallengeService::class => ChallengeService::class,
        ICompanyService::class => CompanyService::class,
        IProgramService::class => ProgramService::class,
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
