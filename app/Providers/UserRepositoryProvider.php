<?php

namespace App\Providers;

use App\Repository\Imp\UserRepositoryImp;
use App\Repository\UserRepository;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class UserRepositoryProvider extends ServiceProvider implements DeferrableProvider
{

    public array $singletons = [
        UserRepository::class => UserRepositoryImp::class
    ];

    public function provides(): array
    {
        return [UserRepository::class, UserRepositoryImp::class];
    }
    /**
     * Register services.
     */
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
