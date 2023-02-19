<?php

namespace Tests\Feature;

use App\Repository\TodolistRepository;
use App\Services\TodolistService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;

class TodolistServiceTest extends TestCase
{
    private TodolistService $todolistService;
    private TodolistService $todolistService2;
    private TodolistRepository $todolistRepository;
    public function setUp(): void
    {
        parent::setUp();
        $this->todolistService = $this->app->make(TodolistService::class);
        $this->todolistService2 = $this->app->make(TodolistService::class);
        $this->todolistRepository = $this->app->make(TodolistRepository::class);
        $this->todolistRepository->deleteAll();
    }

    public function testSingletonService()
    {
        self::assertSame($this->todolistService, $this->todolistService2);
    }

    public function testCreateTodo()
    {
        $todo = new Request();
        $todo["todo"] = "Belajar Laravel";
        $response = $this->todolistService->saveTodo($todo);
        self::assertTrue(true);
    }

    public function testGetTodo()
    {
        $todo = new Request();
        $todo["todo"] = "Belajar Laravel";
        $this->todolistService->saveTodo($todo);
        $response = $this->todolistRepository->getTodo("1");
        self::assertEquals($todo["todo"], $response->todo);
    }
}
