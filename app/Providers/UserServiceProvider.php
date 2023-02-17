<?php

namespace App\Providers;

use App\Services\UserService;
use App\Services\UserServiceImp\UserServiceImp;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        UserService::class => UserServiceImp::class
    ];
    public function provides(): array
    {
        return [UserService::class];
    }
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
