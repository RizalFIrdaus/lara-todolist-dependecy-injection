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

    public function testSaveSuccess()
    {
        $this->todolistService->saveTodo(uniqid(), "Belajar Laravel");
        $this->withSession([
            "user" => "admin"
        ])->get("/todo")
            ->assertSessionHas("todo");
    }

    public function testGetSuccess()
    {
        $uniq = uniqid();
        $this->todolistService->saveTodo($uniq, "Belajar Laravel");
        $response = $this->todolistService->getTodo();
        self::assertEquals([0 => ["id" => $uniq, "todo" => "Belajar Laravel"]], $response);
        $this->withSession([
            "user" => "admin"
        ])->get("/todo")
            ->assertSessionHas("todo");
    }

    public function testRemoveTodo()
    {
        $uniq1 = uniqid();
        $uniq2 = uniqid();
        $this->todolistService->saveTodo($uniq1, "Belajar Laravel");
        $response = $this->todolistService->getTodo();
        self::assertEquals([0 => ["id" => $uniq1, "todo" => "Belajar Laravel"]], $response);
        $this->todolistService->saveTodo($uniq2, "Belajar PHP");
        $response2 = $this->todolistService->getTodo();
        self::assertEquals(
            [
                0 => ["id" => $uniq1, "todo" => "Belajar Laravel"],
                1 => ["id" => $uniq2, "todo" => "Belajar PHP"]
            ],
            $response2
        );
        $this->todolistService->removeTodo($uniq1);
        $response3 = $this->todolistService->getTodo();
        self::assertEquals([1 => ["id" => $uniq2, "todo" => "Belajar PHP"]], $response3);
    }
}
