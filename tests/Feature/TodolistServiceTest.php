<?php

namespace Tests\Feature;

use App\Services\TodolistService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodolistServiceTest extends TestCase
{
    private TodolistService $todolistService;
    private TodolistService $todolistService2;
    public function setUp(): void
    {
        parent::setUp();
        $this->todolistService = $this->app->make(TodolistService::class);
        $this->todolistService2 = $this->app->make(TodolistService::class);
    }

    public function testSingletonService()
    {
        self::assertSame($this->todolistService, $this->todolistService2);
    }
}
