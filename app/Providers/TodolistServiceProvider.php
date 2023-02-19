<?php

namespace App\Providers;

use App\Repository\Imp\TodolistRepositoryImp;
use App\Repository\TodolistRepository;
use App\Services\Imp\TodolistServiceImp;
use App\Services\TodolistService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class TodolistServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        TodolistService::class => TodolistServiceImp::class,
        TodolistRepository::class => TodolistRepositoryImp::class
    ];

    public function provides(): array
    {
        return [TodolistService::class, TodolistRepository::class];
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
